import time
import sqlite3
import ros2_numpy
import numpy as np
import open3d as o3d


from rosidl_runtime_py.utilities import get_message
from rclpy.serialization import deserialize_message

class BagFileParser():
    def __init__(self, bag_file, every_n_frame):
        self.conn = sqlite3.connect(bag_file)
        self.cursor = self.conn.cursor()
        self.every_n_frame = every_n_frame
        
        ## create a message type map
        topics_data = self.cursor.execute("SELECT id, name, type FROM topics").fetchall()
        self.topic_type = {name_of:type_of for id_of,name_of,type_of in topics_data}
        self.topic_id = {name_of:id_of for id_of,name_of,type_of in topics_data}
        self.topic_msg_message = {
            name_of: get_message(type_of)
            for id_of,name_of,type_of in topics_data
            if name_of == '/points' or name_of == '/imu_sensor/imu/nav_sat_fix'
        }
        
        self.nav_timestamps, self.nav_pos = self.get_all_nav_pos()
        self.n_frames = self.get_n_frames() // every_n_frame
    
    
    def get_n_frames(self):
        topic_id = self.topic_id['/points']
        
        query = "SELECT COUNT(*) as count FROM messages WHERE topic_id = {}"
        self.cursor.execute(query.format(topic_id))
        row = self.cursor.fetchmany(1)
        return row[0][0]
    

    def __del__(self):
        self.conn.close()

    # Return [(timestamp0, message0), (timestamp1, message1), ...]
    def get_messages(self, topic_name):
        
        topic_id = self.topic_id[topic_name]
        
        query = """
        SELECT ROWID, timestamp, data
        FROM messages
        WHERE topic_id = {}
        ORDER BY timestamp
        LIMIT 1 OFFSET {};
        """
        
        i = 0
        while True:
            self.cursor.execute(query.format(topic_id, i * self.every_n_frame))
            i += 1
            row = self.cursor.fetchmany(1)
            if len(row):
                for ROWID, timestamp, data in row[:1]:
                    data = deserialize_message(data, self.topic_msg_message[topic_name])
                    yield (ROWID, timestamp, data)
                    
            else:
                break
    
    
    def get_all_nav_pos(self):
        
        topic_name = "/imu_sensor/imu/nav_sat_fix"
        topic_id = self.topic_id[topic_name]
        
        query = """
        SELECT timestamp, data
        FROM messages
        WHERE topic_id = {}
        ORDER BY timestamp
        """
        self.cursor.execute(query.format(topic_id))
        rows = self.cursor.fetchall()
        nav_timestamps = []
        nav_pos = []
        for timestamp, data in rows:
            nav_timestamps.append(timestamp)
            nav_pos.append(deserialize_message(data, self.topic_msg_message[topic_name]))
        return np.array(nav_timestamps), nav_pos
        

class PointCloudConverter:

    @staticmethod
    def write2pcd_file(data, path):
        pcd = o3d.geometry.PointCloud()
        pc_npy  = ros2_numpy.point_cloud2.point_cloud2_to_array(data)['xyz']
        pcd.points = o3d.utility.Vector3dVector(pc_npy)
        o3d.io.write_point_cloud(path, pcd)

    @staticmethod
    def data2pcd(data):
        pc_npy  = ros2_numpy.point_cloud2.point_cloud2_to_array(data)['xyz']
        pcd = o3d.geometry.PointCloud()
        pcd.points = o3d.utility.Vector3dVector(pc_npy)
        return pcd

if __name__ == "__main__":
    bag_file = '/mnt/c/Hack/Dataset/v1/rosbag2_2023_09_09-18_19_28_0.db3'

    parser = BagFileParser(bag_file, 1)
    
    t1 = time.time()
    for i, (ROWID, timestamp, data) in enumerate(parser.get_messages("/points")):
        pass
    
    print(i, time.time() - t1)
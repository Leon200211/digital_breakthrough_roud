import numpy as np
import argparse
from tqdm import tqdm
import requests
import gradio as gr

from src.clusterization import seed_everything
from src.clusterization import Clusters
from src.db3_messages import BagFileParser, PointCloudConverter


def main(bag_file, progress=gr.Progress()):
    seed_everything()
    parser = BagFileParser(bag_file.name, 5)
    
    clusters = Clusters()
    bag_file_response = []
    for i, (ROWID, timestamp, data) in enumerate(parser.get_messages("/points")):
        pcd = PointCloudConverter.data2pcd(data)
        pothole_centroids = clusters.run(
            pcd,
            voxel_size=0.00001,
            distance_threshold=0.05,
            ransac_n=3,
            num_iterations=10000,
            eps=0.1, 
            min_points=10,
            radius=5,
            visualize=False
        )
        # response = []
        for centroid in pothole_centroids:
            div = parser.nav_timestamps - np.array([timestamp])
            nearest_coord_idx = np.argmin(np.where(div > 0, div, np.inf))
            coordinates = parser.nav_pos[nearest_coord_idx]
            bag_file_response.append({
                'marker_coords_y': coordinates.longitude,
                'marker_coords_x': coordinates.latitude,
                'type': 'pothole'
            })
        # if len(response): bag_file_response.append(response)
        progress(1 / (parser.n_frames - i + 1), desc="Sending Images")
    response = requests.post('http://u1988986.isp.regruhosting.ru/uploadData', json={'markers': bag_file_response})
    print(response.status_code)
    return "Data has been sent to site"
    


if __name__ == '__main__':
    
    with gr.Blocks() as block:
        file = gr.File()
        send_btn = gr.Button(value="Обработать")
        text2 = gr.Textbox()
        send_btn.click(main, inputs=[file], outputs=[text2])
    block.queue(concurrency_count=20).launch(server_name="0.0.0.0", allowed_paths=['/tmp'], server_port=7860)
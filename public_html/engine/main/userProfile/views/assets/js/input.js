var loadFile = function(event) {
    var output = document.getElementById('uplode_img');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
};
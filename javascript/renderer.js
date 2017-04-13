$("#submit").click(function (e) {
    e.preventDefault();
    const file = $("#picture")[0].files[0];
    let url = URL.createObjectURL(file);
    let img = new Image();

    img.onload = function () {
        let width = this.naturalWidth/2;
        let height = this.naturalHeight/2;
        $("#imageToShow").css('display', 'block');
        $("#imageToShow").attr({
            'src': url,
            'alt': file.name,
            'width': width,
            'height': height
        });
        $("#imageHeader").text('Filename: ' + file.name);
    };
    img.src = url;
});
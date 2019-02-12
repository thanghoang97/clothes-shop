var total_photos_counter = 0;
Dropzone.options.myDropzone = {
    uploadMultiple: true,
    parallelUploads: 2,
    maxFilesize: 16,
    previewTemplate: document.querySelector('#preview').innerHTML,
    addRemoveLinks: true,
    dictRemoveFile: 'Remove file',
    dictFileTooBig: 'Image is larger than 16MB',
    timeout: 10000,
 
    init: function () {
        this.on("removedfile", function (file) {
            $.post({
                url: '/admin/images-delete',
                data: {id: file.name, _token: $('[name="_token"]').val()},
                dataType: 'json',
                success: function (data) {
                    total_photos_counter--;
                    $("#counter").text("# " + total_photos_counter);
                }
            });
        });
        // this.on('success',function(e){
        //     alert('complete');
        //     var id = $('#prod_id').val();
        //     $.ajax({
        //         url: '/admin/images-show/',
        //         type: 'get',
        //         data: {id:id},
        //         success: function(response){
        //             // console.log(response);
        //             $('#data_pic').html(response);
        //         }
        //     }); 
        // });
    },
    success: function (file, done) {
        total_photos_counter++;
        $("#counter").text("# " + total_photos_counter);
        // var id = $('#prod_id').val();
        // console.log('dropzone' + id);
        //     $.ajax({
        //         url: '/admin/images-show/',
        //         type: 'get',
        //         data: {id:id},
        //         success: function(response){
        //             // console.log(response);
        //             $('#data_pic').html(response);
        //         }
        //     }); 
    }
};
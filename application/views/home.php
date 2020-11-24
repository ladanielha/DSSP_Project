<style>
.btn-square { 
    width        : 200px;
    height       : 200px;
    border-radius: 0;
    font-size    : 20px;
} 
.inputfile {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
}
.btn-upload-plus{
    border-radius: 0 25px 25px 0; 
    margin-left: -4px;
    margin-bottom: 0;
}
.btn-upload-submit{
    border-radius: 25px 0 0 25px;
}
</style>
<script>
function validateFile(){
    var file = fileToUpload.value;
    var len = file.length;
    var ext = file.slice(len - 4, len);
    if(ext.toUpperCase() == ".PDF"){
        $('#fileName').html("<b>" + fileToUpload.value + "</b>");
        $('.btn-upload-submit').removeAttr('disabled');
        $('.btn-upload-submit').html('Upload Document');
        $('.btn-upload-plus').children().removeClass('fa-plus fa-times');
        $('.btn-upload-plus').children().addClass('fa-check');
    }
    else{
        $('#fileName').html("<b>" + fileToUpload.value + "</b>");
        $('.btn-upload-submit').attr('disabled', "true");
        $('.btn-upload-submit').html('PDF File Only');
        $('.btn-upload-plus').children().removeClass('fa-plus fa-check');
        $('.btn-upload-plus').children().addClass('fa-times');
    }
}
setTimeout(function(){
  if ($('#alert').length > 0) {
    $('#alert').remove();
  }
}, 10000)
</script>
<?php

// Cek role user
if($this->session->userdata('role') == 'finance'){ // Jika role-nya admin
    if($this->session->flashdata('data')){ // Jika ada
        $div_success = '<div id="alert" class="alert alert-success">';
        $div_danger = '<div id="alert" class="alert alert-danger">';
        $content = $this->session->flashdata('data')['msg'].'</div>';
        if($this->session->flashdata('data')['status']) echo $div_success.$content;
        else echo $div_danger.$content;
    }
    ?>
    
    <div class="container align-center mb-5">
      <div class="row bg-light p-5" style="border-radius: 25px; width: 75%;">
          <div class="col-md-12">
              <div class="row">
                  <div class="col-md-6 text-center">
                    <h4>Upload Your Document</h4>
                    <p>Upload document and share your documents with others</p>
                    <br>
                    <div>
                        <form action="<?php echo base_url('index.php/action/file_upload'); ?>" method="post" enctype="multipart/form-data">
                            <p id="fileName" style="font-size: 12px; margin-bottom: 5px;"></p>
                            <input type="file" name="fileToUpload" id="fileToUpload" class="inputfile" onChange="validateFile()" accept="application/pdf"/>
                            <button class="btn btn-danger btn-upload-submit" type="submit" disabled>Upload Document</button>
                            <label class="btn btn-danger btn-upload-plus" for="fileToUpload"><i class="fas fa-plus"></i></label>
                        </form>
                    </div>
                  </div>
                  <div class="col-md-6 align-center">
                    <i class="fad fa-file-upload fa-10x"></i>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <hr/>
    <div class="container-fluid py-3">
      <h4>Recent Documents: </h4>
      <div class="row pt-5">
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
      </div>
    </div>

    <?php
}else if($this->session->userdata('role') == 'direksi'){ // Jika role-nya direksi
    ?>
    <h3 class="text-center py-5"> -- Direksi Panel --</h3>
<?php
}
?>
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


.list-container{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    border-radius: 25px;
    transition: .5s ease;
    background-color: #f8f9fa;
    
}
.list-container:hover{
    box-shadow: 0 0 0 3px #343a40;
    transition: .5s ease;
}
.container-left{
    display:flex;
    flex-direction: row;

}
.container-right{
    display: flex;
    flex-direction: row;
}
.preview-img{
    height:100px;
    width:auto;/*maintain aspect ratio*/
    max-width:130px;
    transition: 0.5s ease;
    border-radius: 10px;
}

.preview-img:hover{
    -webkit-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
    transition: 0.5s ease;
    border-radius: 5px;
}
.preview-container{
    margin-right: 1.5rem;
}
.detail-container{
    margin-right: 1.5rem;
    display: flex;
    flex-direction: row;
}
.detail-title{
    margin-right: 1.5rem;
    display: flex;
    flex-direction: column;
}
.detail-content{
    display: flex;
    flex-direction: column;
}
</style>
<script>
function validateFile(){
    var file = fileToUpload.value;
    var len = file.length;
    var ext = file.slice(len - 4, len);
    if(ext.toUpperCase() == ".PDF"){
        $('#fileName').html("<b>" + fileToUpload.value + "</b>");
        $('.btn-upload-submit').html('Upload Document');
        $('.btn-upload-plus').children().removeClass('fa-plus fa-times');
        $('.btn-upload-plus').children().addClass('fa-check');
        $('.btn-upload-submit').removeAttr('disabled');
    }
    else{
        $('#fileName').html("<b>" + fileToUpload.value + "</b>");
        $('.btn-upload-submit').html('PDF File Only');
        $('.btn-upload-plus').children().removeClass('fa-plus fa-check');
        $('.btn-upload-plus').children().addClass('fa-times');
        $('.btn-upload-submit').attr('disabled', 'true');
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
if($this->session->userdata('role') == 'finance'){ // Jika role-nya finance
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
                  <div class="col-lg-6 text-center">
                    <h4>Upload Your Document</h4>
                    Upload document and share your documents with others
                    <div class="mt-5">
                        <form action="<?php echo base_url('index.php/action/file_upload'); ?>" method="post" enctype="multipart/form-data">
                            <select name="direksi" class="custom-select mb-3" required>
                                <option selected disabled>Direksi - Divisi</option>
                                <!-- Loop Direksi -->
                                <?php
                                    foreach($direksi->result() as $dir){
                                        echo '<option value="'.$dir->direksi_id.'">'.ucwords($dir->first_name.' '.$dir->last_name.' - '.$dir->divisi).'</option>';
                                    } 
                                ?>
                            </select>
                            <input type="file" name="fileToUpload" id="fileToUpload" class="inputfile" onChange="validateFile()" accept="application/pdf"/>
                            <div>
                                <div class="row">
                                    <div class="col-sm-10 p-0 m-0"><button class="btn btn-danger btn-block btn-upload-submit" type="submit" disabled>Upload Document</button></div>
                                    <div class="col-sm-2 p-0 m-0"><label class="btn btn-danger btn-block btn-upload-plus" for="fileToUpload"><i class="fas fa-plus"></i></label></div>
                                </div>    
                            </div>
                            <div id="fileName" style="font-size: 12px;"></div>
                        </form>
                    </div>
                  </div>
                  <div class="col-lg-6 align-center mt-2">
                    <i class="fad fa-file-upload fa-10x text-primary"></i>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <hr/>
    <div class="container p-5 bg-light mt-5" style="border-radius: 25px;">
      <h4 class="mx-5"><?php echo ucwords($curr_filter); ?> Documents: </h4>
      <div class="row pt-5 mx-5">
        <?php
            if($dokumen->num_rows() === 0){
                echo "<div class='align-center' style='display:flex; flex-direction: column; width: 100%; height: 300px;'>
                        <div class='text-primary'>
                            <i class='fad fa-folder-open fa-10x'></i>
                        </div>
                        <div>
                            <h4>There's nothing on the desk</h4>
                        </div>
                    </div>";
            }else{
                foreach ($dokumen->result() as $dok){
                    if($dok->status === $curr_filter || $curr_filter === 'all'){
                        $temp = getDireksiById($direksi,$dok->direksi_id);
                        echo '<div class="col-lg-12 p-4 mb-3 list-container">
                            <div class="container-left">
                                <div class="preview-container">
                                    <img class="preview-img" src="'.base_url($dok->thumbnail).'" alt="asd">
                                </div>
                                <div class="detail-container">
                                    <div class="detail-title">
                                        <div>Nama Dokumen </div>
                                        <div>Direksi - Divisi</div>
                                        <div>Upload Date </div>
                                        <div>Due Date </div>
                                    </div>
                                    <div class="detail-content">
                                        <div>: '.$dok->name.'</div>
                                        <div>: '.ucwords($temp->first_name.' '.$temp->last_name.' - '.$temp->divisi).'</div>
                                        <div>: '.date('d M Y H:i:s', $dok->upload_date).'</div>
                                        <div>: '.date('d M Y H:i:s', $dok->due_date).'</div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-right">
                                <a class="mr-5 align-center text-primary" title="Open" href="'.base_url($dok->location).'">
                                    <i class="fad fa-glasses-alt fa-4x"></i>
                                </a>
                                <div class="align-center text-center" style="min-width: 70px;">'.getElementStatus($dok->status).'</div>
                            </div>
                        </div>';
                    }
                    
                }
            }
        ?>
      </div>
    </div>

    <?php
}else if($this->session->userdata('role') == 'direksi'){ // Jika role-nya direksi
    ?>
    <h3 class="text-center py-5"> -- Direksi Panel --</h3>

    <div class="container p-5 bg-light mt-5" style="border-radius: 25px;">
      <h4 class="mx-5"><?php echo ucwords($curr_filter); ?> Documents: </h4>
      <div class="row pt-5 mx-5">
        <?php
            if($dokumen->num_rows() === 0){
                echo "<div class='align-center' style='display:flex; flex-direction: column; width: 100%; height: 300px;'>
                        <div class='text-primary'>
                            <i class='fad fa-folder-open fa-10x'></i>
                        </div>
                        <div>
                            <h4>There's nothing on the desk</h4>
                        </div>
                    </div>";
            }else{
                foreach ($dokumen->result() as $dok){
                    if($dok->status === $curr_filter || $curr_filter === 'all'){
                        $temp = getDireksiById($direksi,$dok->direksi_id);
                        echo '<div class="col-lg-12 p-4 mb-3 list-container">
                            <div class="container-left">
                                <div class="preview-container">
                                    <img class="preview-img" src="'.base_url($dok->thumbnail).'" alt="asd">
                                </div>
                                <div class="detail-container">
                                    <div class="detail-title">
                                        <div>Nama Dokumen </div>
                                        <div>Direksi - Divisi</div>
                                        <div>Upload Date </div>
                                        <div>Due Date </div>
                                    </div>
                                    <div class="detail-content">
                                        <div>: '.$dok->name.'</div>
                                        <div>: '.ucwords($temp->first_name.' '.$temp->last_name.' - '.$temp->divisi).'</div>
                                        <div>: '.date('d M Y H:i:s', $dok->upload_date).'</div>
                                        <div>: '.date('d M Y H:i:s', $dok->due_date).'</div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-right">
                                <a class="mr-5 align-center text-primary" title="Open" href="'.base_url('index.php/Page/viewmail/'.$dok->dokumen_id).'">
                                    <i class="fad fa-glasses-alt fa-4x"></i>
									$temp = getElementDokID($dok->dokumen_id);
                                </a>
                                <div class="align-center text-center" style="min-width: 70px;">'.getElementStatus($dok->status).'</div>
                            </div>
                        </div>';
                    }
                    
                }
            }
        ?>
      </div>
    </div>
<?php
}
?>
<?php
    //Function
    function getDireksiById($direksi, $direksi_id){
        foreach($direksi->result() as $dir){
            if($dir->direksi_id === $direksi_id){
                return $dir;
            }
        }
    }
    function getElementStatus($status){
        if($status === 'approved'){
            return '<a class="align-center text-center text-success" title="Approved" href="'.base_url('index.php/page/dashboard?filter=approved').'">
                        <i class="fad fa-file-check fa-4x"></i>
                    </a>';
        }elseif($status === 'rejected'){
            return '<a class="align-center text-center text-danger" title="Rejected" href="'.base_url('index.php/page/dashboard?filter=rejected').'">
                        <i class="fad fa-file-times fa-4x"></i>
                    </a>';
        }elseif($status === 'pending'){
            return '<a class="align-center text-center text-warning" title="Pending" href="'.base_url('index.php/page/dashboard?filter=pending').'">
                        <i class="fad fa-clock fa-4x"></i>
                    </a>';
        }
    }
	
?>
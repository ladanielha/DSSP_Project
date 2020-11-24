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
    <h3 class="text-center py-5"> -- Finanace Panel --</h3>
    <?php
}else if($this->session->userdata('role') == 'direksi'){ // Jika role-nya direksi
    ?>
    <h3 class="text-center py-5"> -- Direksi Panel --</h3>
	<?php foreach ($dokumen_detail->result_array() as $dokumen) : ?>
		<h1 id="judul-berita"><?php echo $row['Judul_berita'] ?></h1>
		<iframe src="<?php  echo base_url('assets/uploads/files/ . $dokumen['location']')?>" height="1080" width="100%" title="Iframe Example"></iframe>
	<?php endforeach ?>
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
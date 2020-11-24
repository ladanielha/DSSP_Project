<?php
    if($this->session->flashdata('message')){ // Jika ada
        echo '<div class="alert alert-success">'.$this->session->flashdata('message').'</div>'; // Tampilkan pesannya
    }
    if($this->session->flashdata('error')){ // Jika ada
        echo '<div class="alert alert-danger">'.$this->session->flashdata('error').'</div>'; // Tampilkan pesannya
    }
?>
<?php $role = $this->session->userdata('role'); //Memperpendek code?>
<h1 class="text-center py-5"><i class="fad fa-id-card"></i> <?php echo $curr_page; ?></h1>
<div class="row">
    <div class="col-sm-4 text-center mb-5">
        <!-- <h3>Profile</h3> -->
        <i class="fas fa-user-circle fa-10x" style="color:#AEC6CF;"></i>
        <div class="pt-5">
            <h3><?php echo $user->first_name." ".$user->last_name;?></h3>
            <h5><?php echo "--".$role."--"; ?></h5>
        </div>

        <?php if($role == 'siswa'){?>
        <style>
            .h5{
                display: inline;
            }
        </style>
        <!-- Siswa -->
        <table class="pt-5 text-left mx-auto" style="width:60%;">
            <tr>
                <th>Angkatan</th>
                <td class="h5"><?php echo $user->tahun_masuk;?></td>
            </tr>
            <tr>
                <th>Kelas</th>
                <td class="h5"><?php echo $kelas->name;?></td>
            </tr>
        </table>
        <?php } ?>
    
    </div>
    <div class="col-sm-8">
        
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#profile">About Me</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#account">Account</a>
            </li>
        </ul>

        <div class="tab-content py-3">
            <div class="tab-pane container active" id="profile">
                <form method="post" action="<?php echo base_url('index.php/page/form_profile'); ?>">

                    <?php if($role != 'admin'){?>
                    <!-- NIP/NISN -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="iNI"><?php echo($role == 'guru' ? "NIP" : "NISN"); ?></label>
                                <input name="iNI" type="text" class="form-control input-box" value="<?php echo($role == 'guru' ? $user->nip : $user->nisn); ?>" placeholder="<?php echo($role == 'guru' ? $user->nip : $user->nisn); ?>" required disabled>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <!-- Name -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="iFName">First Name</label>
                                <input name="iFName" type="text" class="form-control input-box" value="<?php echo $user->first_name;?>" placeholder="<?php echo $user->first_name;?>" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="iLName">Last Name</label>
                                <input name="iLName" type="text" class="form-control input-box" value="<?php echo $user->last_name;?>" placeholder="<?php echo $user->last_name;?>" required>
                            </div>
                        </div>
                    </div>

                    <!-- Gender & BDate -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="iGender">Gender</label>
                                <select name="iGender" class="form-control" required>
                                    <option value="1" <?php echo ($user->gender == 'Male'? "selected" : "");?> >Male</option>
                                    <option value="2" <?php echo ($user->gender == 'Female'? "selected" : "");?> >Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="iBDate">Birthday (D/M/Y)</label>
                                <input name="iBDate" type="date" class="form-control input-box" value="<?php echo $user->birth_date;?>" required>
                            </div>
                        </div>
                    </div>
                    
                    <button class = "btn btn-primary btn-block" type="submit">Save Changes</button>
                
                </form>
            </div>
            <div class="tab-pane container fade" id="account">
                <form method="post" action="<?php echo base_url('index.php/page/form_account'); ?>">

                    <!-- Username -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control input-box" value="<?php echo $user->username; ?>" placeholder="<?php echo $user->username; ?>"  name="username" required disabled>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Current Password -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="curr_password">Current Password</label>
                                <input type="password" class="form-control input-box form-password" placeholder="Current Password"  name="curr_password" required>
                            </div>
                        </div>
                    </div>

                    <!-- New Password -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control input-box form-password" placeholder="New Password"  name="new_password" required>
                            </div>
                        </div>
                    </div>
                    <div class="py-3">
                        <input type="checkbox" class="form-checkbox"> Show Password
                    </div>
                    <button class = "btn btn-primary btn-block" type="submit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){		
		$('.form-checkbox').click(function(){
			if($(this).is(':checked')){
				$('.form-password').attr('type','text');
			}else{
				$('.form-password').attr('type','password');
			}
		});
	});
</script>
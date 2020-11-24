<?php
foreach($crud['css_files'] as $file): ?>
    <link type = "text/css" rel = "stylesheet" href = "<?php echo $file; ?>" />
<?php endforeach; ?>

<?php
foreach($crud['js_files'] as $file): ?>
    <script src = "<?php echo $file; ?>"></script>
<?php endforeach; ?>

<div class = "container-fluid text-center py-3">
    <?php
        $curr_role = $this->session->userdata('role');
    ?>
    <h5> -- <?php echo $curr_role;?> Panel --</h5>
    
    <h1>
        <i class="fad fa-<?php 
            switch ($curr_page) {
                case 'matpel':
                    echo 'books';
                    break;
                case 'kelas':
                    echo 'users-class';
                    break;
                case 'lesson':
                    echo 'book-reader';
                    break;
                case 'guru':
                    echo 'chalkboard-teacher';
                    break;
                case 'siswa':
                    echo 'backpack';
                    break;
                case 'nilai':
                    echo 'file-certificate';
                    break;
                default:
                    echo 'school';
                    break;
            }
        ?>"></i> 
        <?php echo ($curr_page != "matpel" ? $curr_page : "Mata Pelajaran" );?>
    </h1>

    <?php if(isset($sub_page)) echo '<h2>'.$sub_page.'</h2>'?>
    
</div>

<div class = "row">
<div class = "col-md-12">
        <?php
            echo $crud['output'];
        ?>
    </div>
</div>

<html>
<head>
    <meta charset="utf-8">
    <title>File Upload</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>

<div class="container mt-5">
    <h2>File Upload</h2>
    <!--<h2>PHP Version</h2>
<p><?php echo $php_version; ?></p>-->
    <?php echo form_open_multipart('masters/file_upload/upload', 'class="mt-3"'); ?>
    <div class="form-group">
        <label for="userfile">Choose File:</label>
        <input type="file" class="form-control" name="userfile" />
    </div>
    <div class="form-group" hidden>
        <label for="file_name">File Name:</label>
        <input type="text" class="form-control" name="file_name" />
    </div>

    <button type="submit" class="btn btn-primary">Upload</button>
    </form>

    <h2 class="mt-5">Files</h2>
    <div>
        <?php if(!empty($files)) { ?>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>File Name</th>
                        <th>Date</th>
                        <th>Action </th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($files as $key => $file) { ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $file['file']; ?></td>
                            <td><?php echo $file['created_date']; ?></td>
                            <td><a href="<?php echo base_url('masters/file_upload/download/'.$file['id']); ?>" class="btn btn-success">Download</a> <a href="<?php echo base_url('masters/file_upload/delete/'.$file['id']); ?>" class="btn btn-danger" onclick="confirmDelete()">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="mt-3">No files found</p>
        <?php } ?>
    </div>
</div>

<!-- Bootstrap JS and jQuery (Include at the end of the body for faster page load) -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    // Function to show SweetAlert success message for file upload
    <?php if ($this->session->flashdata('upload_success_message')) { ?>
        Swal.fire({
            icon: 'success',
            title: 'Upload Success',
            text: '<?php echo $this->session->flashdata('upload_success_message'); ?>',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            <?php $this->session->unset_userdata('upload_success_message'); ?>
        });
    <?php } ?>

    $(document).ready(function(){
        // Function to show SweetAlert success message for file deletion
        <?php if ($this->session->flashdata('delete_success_message')) { ?>
            Swal.fire({
                icon: 'success',
                title: 'Delete Success',
                text: '<?php echo $this->session->flashdata('delete_success_message'); ?>',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                <?php $this->session->unset_userdata('delete_success_message'); ?>
            });
        <?php } ?>
    });
</script>



</body>
</html>

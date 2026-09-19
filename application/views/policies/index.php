<style>
.container {
    margin-left: 300px;
    margin-top: 100px;
}

</style>
<div class="container">

    <h2>Employee Policies</h2>

    <?php if($this->session->userdata('user_role_add') == 1){ ?>
        <a href="<?= site_url('admin/addpolicy') ?>" class="btn btn-primary" style="margin-bottom:15px;">
            Add New Policy
        </a>
    <?php } ?>

    <table id="policiesTable" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Status</th>
            <th>Created</th>
            <th>Updated</th>
            <?php if($this->session->userdata('user_role_edit') == 1 || $this->session->userdata('user_role_delete') == 1){ ?>
                <th>Action</th>
            <?php } ?>

        </tr>
        </thead>
        <tbody>

        <?php foreach($policies as $p): ?>
            <tr>
                <td><?= $p->id ?></td>
                <td><?= $p->title ?></td>
                <td>
                    <?= $p->status == 1 ? '<span class="badge badge-success">Active</span>'
                        : '<span class="badge badge-danger">Inactive</span>'; ?>
                </td>
                <td><?= $p->created ?></td>
                <td><?= $p->updated ?></td>
                <td>

                    <?php if($this->session->userdata('user_role_edit') == 1){ ?>
                        <a href="<?= site_url('admin/editpolicy/'.$p->id) ?>" class="btn btn-sm btn-info">Edit</a>
                    <?php } ?>

                    <?php if($this->session->userdata('user_role_delete') == 1){ ?>
                        <a href="<?= site_url('admin/deletepolicy/'.$p->id) ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Delete this?')">
                            Delete
                        </a>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>

</div>

<script>
    $(document).ready(function () {
        $('#policiesTable').DataTable();
    });
</script>
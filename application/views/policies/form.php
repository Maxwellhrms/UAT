<style>
    .container {
        margin-left: 300px;
        margin-top: 100px;
    }

</style>
<div class="container">

    <h2><?= isset($policy) ? "Edit Policy" : "Add Policy" ?></h2>

    <form method="post">

        <div class="form-group">
            <label>Policy Title</label>
            <input type="text" class="form-control" name="title"
                   value="<?= isset($policy) ? $policy->title : '' ?>" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea id="editor" name="description" required>
                <?= isset($policy) ? $policy->description : '' ?>
            </textarea>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="1" <?= isset($policy) && $policy->status == 1 ? "selected":"" ?>>Active</option>
                <option value="0" <?= isset($policy) && $policy->status == 0 ? "selected":"" ?>>Inactive</option>
            </select>
        </div>

        <br>

        <button type="submit" class="btn btn-success">
            <?= isset($policy) ? "Update Policy" : "Save Policy" ?>
        </button>

        <a href="<?= site_url('admin/userpolicies') ?>" class="btn btn-secondary">Back</a>
    </form>

</div>
<script src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js"></script>
<script>
    console.log(baseurl+'assets/ckeditor/contents.css')
    console.log(baseurl+'assets/ckeditor/mentions/contents.css')

    tags = ['american','asian','baking','breakfast','cake','caribbean','chinese','chocolate','cooking','dairy','delicious','delish','dessert','desserts','dinner','eat','eating','eggs','fish','food','foodgasm','foodie','foodporn','foods','french','fresh','fusion','glutenfree','greek','grilling','halal','homemade','hot','hungry','icecream','indian','italian','japanese','keto','korean','lactosefree','lunch','meat','mediterranean','mexican','moroccan','nom','nomnom','paleo','poultry','snack','spanish','sugarfree','sweet','sweettooth','tasty','thai','vegan','vegetarian','vietnamese','yum','yummy'
    ];

    CKEDITOR.replace('editor', {
        // plugins: 'mentions,emoji,basicstyles,undo,link,wysiwygarea,toolbar, pastefromgdocs, pastefromlibreoffice, pastefromword',
        contentsCss: [
            baseurl+'assets/ckeditor/contents.css',
            baseurl+'assets/ckeditor/mentions/contents.css'
        ],
        height: 350,
        toolbar: [
            { name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview' ] },
            [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],
            { name: 'links', items: [ 'Link', 'Unlink','JustifyLeft','JustifyCenter', 'JustifyRight', 'JustifyBlock','NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote','Table' ] },
            { name: 'basicstyles', items: [ 'Bold', 'Italic' ] },
            { name: 'tools', items: ['Maximize', 'ShowBlocks']},
        ],
        mentions: [{
            feed: dataFeed,
            itemTemplate: '<li data-id="{id}">' +
                '<img class="photo" style="border: 2px solid #fff;border-radius: 100%; height:30px; width:30px;" src="{avatar}" />' +
                '<strong class="username">{username}</strong>' +
                ' <span class="fullname">[{email}]</span>' +
                '</li>',
            outputTemplate: '<a href="mailto:{email}">[{email}]</a><span>&nbsp;</span>',
            minChars: 0
        },
            {
                feed: tags,
                marker: '#',
                itemTemplate: '<li data-id="{id}"><strong>{name}</strong></li>',
                // outputTemplate: '<a href="https://example.com/social?tag={name}">{name}</a><span>&nbsp;</span>',
                minChars: 1
            }
        ],
        removeButtons: 'PasteFromWord'
    });

    function dataFeed(opts, callback) {
        var matchProperty = 'username',
            data = users.filter(function(item) {
                return item[matchProperty].indexOf(opts.query.toLowerCase()) == 0;
            });

        data = data.sort(function(a, b) {
            return a[matchProperty].localeCompare(b[matchProperty], undefined, {
                sensitivity: 'accent'
            });
        });

        callback(data);
    }
</script>
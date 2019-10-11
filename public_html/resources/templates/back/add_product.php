<?php add_product(); ?>
<div class="col-md-12">

    <div class="row">
        <h1 class="page-header">
            Add Product

        </h1>
    </div>



    <form action="" method="post" enctype="multipart/form-data">
        <div class="col-md-8">

            <div class="form-group">
                <label for="product-title">Product Title </label>
                <input type="text" name="product_title" class="form-control">

            </div>


            <div class="form-group">
                <label for="product-title">Product Description</label>
                <textarea name="product_description " id="" cols="30" rows="10" class="editor form-control"></textarea>
            </div>



            <div class="form-group row">

                <div class="col-xs-3">
                    <label for="product-price">Product Price</label>
                    <input type="number" name="product_price" class="form-control" size="60">
                </div>
            </div>



            <div class="form-group">
                <label for="product-title">Product Short Description</label>
                <textarea name="short_desc" id="short_desc" cols="30" rows="3" class="form-control"></textarea>
            </div>

        </div>
        <!--Main Content-->


        <!-- SIDEBAR-->


        <aside id="admin_sidebar" class="col-md-4">

            <div class="form-group">
                <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
                <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
            </div>

            <!-- Product Categories-->

            <div class="form-group">
                <label for="product-title">Product Category</label>
                <select name="product_category_id" id="" class="form-control">
<!--                    function-->
               <?php backend_addproductpage_categories();?>
                </select>


            </div>

            <!-- Product Brands-->

            <div class="form-group">
                <label for="product-title">Product Quantity</label>
                <input type="number" name="product_quantity" class="form-control">
            </div>


            <!-- Product Tags -->


            <!--
            <div class="form-group">
                <label for="product-title">Product Keywords</label>
                <hr>
                <input type="text" name="product_tags" class="form-control">
            </div>
-->

            <!-- Product Image -->
            <div class="form-group">
                <label for="product-title">Product Image</label>
                <input type="file" name="file">
            </div>



        </aside>
        <!--SIDEBAR-->


    </form>







    <script>
        ClassicEditor
            .create(document.querySelector('.editor'), {
                //'imageUpload', 'mediaEmbed'
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo'],
                image: {
                    toolbar: ['imageStyle:full', 'imageStyle:side', '|', 'imageTextAlternative']
                },
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                }
            })
            .catch(error => {
                console.log(error);

            });

        ClassicEditor
            .create(document.querySelector('#short_desc'),
        {

                //'imageUpload', 'mediaEmbed'
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo'],
                image: {
                    toolbar: ['imageStyle:full', 'imageStyle:side', '|', 'imageTextAlternative']
                },
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                }
            })
            .then(editor => {
                console.log(Array.from(editor.ui.componentFactory.names()))
            })
            .catch(error => {
                console.log(error);

            });

    </script>

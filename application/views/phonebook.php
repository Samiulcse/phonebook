<div class="container">
	<!-- Page Heading -->
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <h2><?php echo ucwords($this->session->userdata['user_name'])?>  Phonebook
                    <div class="float-right mb-30"><a href="<?php echo(base_url('login/logout'))?>" class="btn btn-warning logout">Logout</a><a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Add New</a></div>
                </h2>
            </div>

            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody id="show_data">

                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- MODAL ADD -->
    <form>
    <div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Number</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Name</label>
                    <div class="col-md-10">
                        <input type="text" name="phonebook_name" id="phonebooK_name" class="form-control" placeholder="Product Code">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Phone Number</label>
                    <div class="col-md-10">
                        <input type="number" name="phonebook_phone" id="phonebook_phone" class="form-control" placeholder="Product Name">
                        <input type="hidden" name="phonebook_user_id" id="phonebook_user_id" value="<?php echo $this->session->userdata['user_id']?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Address</label>
                    <div class="col-md-10">
                        <textarea name="phonebook_address" class="form-control" id="phonebook_address" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="btn_save" class="btn btn-primary">Save</button>
            </div>
        </div>
        </div>
    </div>
    </form>
<!--END MODAL ADD-->

<!-- MODAL EDIT -->
<form>
    <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Product Code</label>
                    <div class="col-md-10">
                        <input type="text" name="product_code_edit" id="product_code_edit" class="form-control" placeholder="Product Code" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Product Name</label>
                    <div class="col-md-10">
                        <input type="text" name="product_name_edit" id="product_name_edit" class="form-control" placeholder="Product Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Price</label>
                    <div class="col-md-10">
                        <input type="text" name="price_edit" id="price_edit" class="form-control" placeholder="Price">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" type="submit" id="btn_update" class="btn btn-primary">Update</button>
            </div>
        </div>
        </div>
    </div>
    </form>
<!--END MODAL EDIT-->

<!--MODAL DELETE-->
    <form>
    <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <strong>Are you sure to delete this record?</strong>
            </div>
            <div class="modal-footer">
            <input type="hidden" name="product_code_delete" id="product_code_delete" class="form-control">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="button" type="submit" id="btn_delete" class="btn btn-primary">Yes</button>
            </div>
        </div>
        </div>
    </div>
    </form>
<!--END MODAL DELETE-->
<script>
$(document).ready(function () {
    show_phonenumber();	//call function show all Phone Number
		
    $('#mydata').dataTable();
        
    //function show all product
    function show_phonenumber(){
        $.ajax({
            type  : 'ajax',
            url   : '<?php echo site_url('phonebook/phone_book_data')?>',
            async : false,
            dataType : 'json',
            success : function(data){
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<tr>'+
                            '<td>'+data[i].product_code+'</td>'+
                            '<td>'+data[i].product_name+'</td>'+
                            '<td>'+data[i].product_price+'</td>'+
                            '<td style="text-align:right;">'+
                                '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-product_code="'+data[i].product_code+'" data-product_name="'+data[i].product_name+'" data-price="'+data[i].product_price+'">Edit</a>'+' '+
                                '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-product_code="'+data[i].product_code+'">Delete</a>'+
                            '</td>'+
                            '</tr>';
                }
                $('#show_data').html(html);
            }

        });
    }
});
</script>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Declaration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('itdeclaration.store') }}" id="editdeclarationform"  enctype="multipart/form-data" class="form-horizontal adddeclaration-form" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="modal-body">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="category" class="control-label">Category<small class="text-danger required">*</small></label>
                            <select name="category"  id="edit_category" class="form-control" onchange="getchildcategory(this.value,'{{route('itdeclaration.getcategory')}}')" required>
                                @foreach($category->childCategory as $childcategory)
                                    <option value="{{$childcategory->id}}" {{old('category')== $childcategory->id ? 'selected':""}}>{{$childcategory->label}}</option>
                                @endforeach
                            </select>

                        </div>
                        @error('category')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12" id="childCategorydiv_edit" style="display: none;">
                        <div class="form-group">
                            <label for="childcategory" class="control-label">Select Sub Category<small class="text-danger required">*</small></label>
                            <select name="childcategory" id="childcategory_edit" class="form-control"  onchange="checkcategory(this.value)">
                                <option value="" selected> Select </option>
                                @foreach($subcategory->childCategory as $childcategory)
                                    <option value="{{$childcategory->id}}" {{old('childcategory')== $childcategory->id ? 'selected':""}}>{{$childcategory->label}}</option>
                                @endforeach
                            </select>

                        </div>
                        @error('childcategory')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12" id="companynamediv_edit">
                        <div class="form-group">
                            <label for="company_name" id="company_name_label" class="control-label">Name<small class="text-danger required">*</small></label>
                            <input type="text" name="company_name" id="edit_company_name" class="form-control" required>

                        </div>
                        @error('company_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12" id="amountdiv_edit" >
                        <div class="form-group">
                            <label for="amount" class="control-label">Amount<small class="text-danger required">*</small></label>
                            <input type="number" name="amount" id="edit_amount" class="form-control" required>

                        </div>
                        @error('amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12" id="addressdiv_edit" style="display: none">
                        <div class="form-group">
                            <label for="address" class="control-label">Address<small class="text-danger required">*</small></label>
                            <textarea  name="address" id="address" class="form-control" ></textarea>

                        </div>
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="documents" class="control-label">Upload Documents<small class="text-danger required">*</small></label>
                            <input type="file" name="documents[]"  multiple="multiple" id="documents" class="form-control"  accept="application/pdf">

                        </div>
                        <span class="text-danger documents_form_error"><p></p></span>
                        <small>Allowed File Formats: PDF</small>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"  data-url="{{route('itdeclaration.listdata')}}">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('css')
    <style>
        input[type="file"] {
            display: block;
        }
        .imageThumb {
            max-height: 75px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
        }
        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
        }
        .remove {
            display: block;
            background: #e12717;
            border: 1px solid red;
            color: white;
            text-align: center;
            cursor: pointer;
        }
        .remove:hover {
            background: white;
            color: red;
        }</style>
@endsection

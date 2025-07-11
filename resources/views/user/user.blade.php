@extends('layout.header')
<div class="layout-page">
<div class="content-wrapper">
<div class="container-xxl flex-grow-1 container-p-y">
 

<div class="card">
<div class="offcanvas offcanvas-end" id="add-new-record" >
                <div class="offcanvas-header border-bottom">
                  <h5 class="offcanvas-title">New Record</h5>
                <button
                type="button"
                class="btn-close text-reset"
                data-bs-dismiss="offcanvas"
                aria-label="Close">
                </button>
                </div>

                <div class="offcanvas-body flex-grow-1">
                

                <form class="add-new-record pt-0 row g-2" method="post" action="{{ url('/user') }}">
                    @csrf
                    @if ($errors->any())
    <div class="alert alert-danger mt-2">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


                    <div class="col-sm-12 form-control-validation">
                      <label class="form-label" for="basicFullname">Full Name</label>
                      <div class="input-group input-group-merge">
                        <span id="basicFullname2" class="input-group-text"
                          ><i class="icon-base ti tabler-user"></i
                        ></span>
                        <input
                          type="text"
                          id="basicFullname"
                          class="form-control dt-full-name"
                          name="name"
                          placeholder="John Doe"
                          aria-label="John Doe"
                          aria-describedby="basicFullname2" />
                      </div>
                    </div>
                    <div class="col-sm-12 form-control-validation">
                      <label class="form-label" for="basicPost">Email</label>
                      <div class="input-group input-group-merge">
                        <span id="basicPost2" class="input-group-text"
                          ><i class="icon-base ti tabler-email"></i
                        ></span>
                        <input
                          type="text"
                          id="email"
                          name="email"
                          class="form-control dt-post"
                          placeholder="example@gmail.com"
                          aria-label="Web Developer"
                          aria-describedby="basicPost2" />
                      </div>
                    </div>

                    <div class="col-sm-12 form-control-validation">
                      <label class="form-label" for="basicPost">Password</label>
                      <div class="input-group input-group-merge">
                        <span id="basicPost2" class="input-group-text"
                          ><i class="icon-base ti tabler-password"></i
                        ></span>
                        <input
                          type="password"
                          id="password"
                          name="password"
                          class="form-control dt-post"
                          placeholder="Password"
                          aria-label="Web Developer"
                          aria-describedby="basicPost2" />
                      </div>
                    </div>

                    <div class="col-sm-12 form-control-validation">
    <label class="form-label">Status</label>
    <div class="input-group input-group-merge">
        <span class="input-group-text">
            <i class="icon-base ti tabler-user"></i>
        </span>
        <select name="roles[]" class="form-control styled-multiselect">
            @foreach ($roles as $value => $label)
                <option value="{{ $value }}" {{ in_array($value, $userRole ?? []) ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>
</div>

                    
                    <!-- <div class="col-sm-12 form-control-validation">
                      <label class="form-label" for="basicPost">Role:</label>
                      <div class="input-group input-group-merge">
                      <span id="basicPost2" class="input-group-text"><i class="icon-base ti tabler-password">
                        </i></span>
                        

                
                      </div>
                    </div> -->


                    <div class="col-sm-12 form-control-validation">
                      <!-- <label class="form-label" for="basicSalary">Role</label> -->
                      <div class="input-group input-group-merge">
                        
              </div>
</div>

<div class="col-sm-12">
                      <button type="submit" class="btn btn-primary data-submit me-sm-4 me-1">Submit</button>
                      <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                    </div>
                  </form>
                </div>
              </div>

                           

              <!--table-->
              
                <div class="card-datatable text-nowrap">
                <div class="row card-header flex-column flex-md-row mx-0 px-3">
                    <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto me-auto mt-0">
                        <h5 class="card-title mb-0 text-md-start text-center pb-md-0 pb-6">Users Detail</h5>
                    </div>
                    <div class="d-md-flex justify-content-between align-items-center dt-layout-end col-md-auto ms-auto mt-0">
                        <div class="dt-buttons btn-group flex-wrap mb-0">  
                            <div class="btn-group">
                                <button class="btn buttons-collection btn-label-primary dropdown-toggle me-4" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">
                                    <span>
                                        <span class="d-flex align-items-center gap-2">
                                            <span class="d-none d-sm-inline-block">Export</span>
                                        </span>
                                    </span>
                                </button>
                                <button
                            type="button"
                            class="btn btn-primary ms-auto" 
                            aria-controls="add-new-record"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#add-new-record">
                            <i class="icon-base ti tabler-plus icon-sm"></i> 
                            <span class="d-none d-sm-inline-block">Add New Record</span>
                                    </span>
                            </button> 
                            </div>
                      
                        </div>
                    </div>
                </div>               
</div>
<br>
                  <table class="dt-complex-header table table-responsive">
                    <thead class="table-active text-center">
                      <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>   
                      </tr>
                      
                    </thead></b>
                    <tbody class="table-border-bottom-0">
                    @foreach($result as $userdata)
                      <tr class="text-center">  
                        <td>{{$userdata->name}}</td>
                        <td>{{$userdata->email}}</td>
                        <td>
                        @if(!empty($userdata->getRoleNames()))
            @foreach($userdata->getRoleNames() as $v)
               <label class="badge bg-success">{{ $v }}</label>
            @endforeach
          @endif
                        </td>
                        
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="icon-base ti tabler-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu">   
                            <a class="dropdown-item" href="{{ url('/user/' . $userdata->id) }}" data-bs-toggle="modal" data-bs-target="#editModal{{ $userdata->id }}">
                            <i class="icon-base ti tabler-pencil me-1"></i> Edit
                            </a>
                            <a class="dropdown-item" href="{{ route('users.users', $userdata->id) }}" data-delete>
    <i class="icon-base ti tabler-trash me-1"></i> Delete
</a>
                              </td>
                              </tr>

                              @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        
        
    </div>
@endif


                              <div class="modal fade" id="editModal{{$userdata->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $userdata->id }}" aria-hidden="true">            
  <div class="modal-dialog modal-dialog-centered" style="max-width: 70%; ">
    <div class="modal-content">
    <form action="{{ url('user/'.$userdata->id) }}" id="EditForm{{$userdata->id}}" method="post">
    @csrf
    @method('PUT')
      <!-- Modal Header -->
      <div class="modal-header">
      <h5 class="modal-title" id="editModalLabel{{ $userdata->id }}">Update Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
<!-- Modal Body -->
      <div class="modal-body">
        <!-- Example Form -->
        <div class="mb-12">
            <label for="editName" class="form-label">Username</label>
            <input type="text" class="form-control" id="editName" name="name" value="{{ old('name', $userdata->name) }}" required>
          </div>
          <div class="mb-12">
            <label for="editEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="editEmail" name="email" value="{{ old('email', $userdata->email) }}" required>
          </div>
          <div class="mb-12">
                <label>Role:</label>
                <select name="roles[]" class="form-control">
                    @foreach ($roles as $value => $label)
                        <option value="{{ $value }}" {{ isset($userRole[$value]) ? 'selected' : ''}}>
                            {{ $label }}
                        </option>
                     @endforeach
                </select>
            
          </div>
        
      </div>

<!-- Modal Footer -->
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" form="EditForm{{$userdata->id}}" class="btn btn-primary">Save Changes</button>
      </div>
</div>
    </div>
  </div>
  </form>
</div>
             @endforeach
          </tbody>
                  </table>
             </div>
              </div> 
              
              
              <div class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 1100">
    <div id="deleteToast" class="toast text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex align-items-center justify-content-between">
            <div class="toast-body d-flex align-items-center">
                
                Are you sure you want to delete this data?
            </div>
            <div class="d-flex align-items-center ms-3">
                <button id="confirmDeleteToastBtn" class="btn btn-sm btn-light me-2">Yes</button>
                <button type="button" class="btn-close btn-close-white me-2" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteToastEl = document.getElementById('deleteToast');
        const deleteToast = new bootstrap.Toast(deleteToastEl);
        const confirmBtn = document.getElementById('confirmDeleteToastBtn');
        let pendingDeleteUrl = null;

        // Handle click on delete link
        document.querySelectorAll("a.dropdown-item[data-delete]").forEach(link => {
            link.addEventListener("click", function (e) {
                e.preventDefault();
                pendingDeleteUrl = this.getAttribute('href');
                deleteToast.show();
            });
        });

        // Confirm button in toast
        confirmBtn.addEventListener("click", function () {
            if (pendingDeleteUrl) {
                window.location.href = pendingDeleteUrl;
            }
        });
    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
  // Works for all 'select all' toggle switches
  document.querySelectorAll('.select-all-toggle').forEach(function(toggle) {
    toggle.addEventListener('change', function() {
      const roleId = this.id.replace('selectAllToggle', '');
      const checkboxes = document.querySelectorAll('.permission-checkbox-' + roleId);

      checkboxes.forEach(function(checkbox) {
        checkbox.checked = toggle.checked;
      });
    });
  });
});
</script>

              @if(isset($openModal) && $openModal)
  <script>
    window.onload = function () {
      var editModal = new bootstrap.Modal(document.getElementById('editModal'));
      editModal.show();
    };
  </script>
@endif
@extends('layout.footer')

      



                
               

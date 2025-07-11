@extends('layout.header')

<!-- / Navbar -->
<div class="layout-page">
  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="mb-1">Roles List</h4>
      <p class="mb-6">
        A role provided access to predefined menus and features so that depending on <br />
        assigned role an administrator can have access to what user needs.
      </p>

      <!-- Role cards -->
      <div class="row g-6">
        <div class="col-xl-12 col-lg-12 col-md-6">
          <div class="card"></div>
        </div>

        <!-- <div class="card h-100">
          <div class="row h-100">
            <div class="col-sm-7">
              <div class="card-body text-sm-end text-center ps-sm-0"></div>
            </div>
          </div>
        </div> -->

        <div class="col-12">
          <!-- Role Table -->
          <div class="card">
            <div class="card-datatable">
              <!-- <button data-bs-target="#addRoleModal" data-bs-toggle="modal" class="btn btn-sm btn-primary mb-4 text-nowrap add-new-role">
                Add New Role
              </button> -->
              

              <div class="d-flex justify-content-between align-items-center mb-3">              
                  <h4 class="mt-6 mb-1">&nbsp;&nbsp;&nbsp;&nbsp;Total users with their roles</h4>
                  <button
    data-bs-target="#addRoleModal"
    data-bs-toggle="modal"
    class="btn btn-primary float-end me-6 my-6">
    Add New Role
    </button>
</div>
  <table class="datatables-users table border-top">
                <thead class="table-active text-center">
                  <tr class="text-center">
                    <th>No.</th>
                    <th>User</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                  @foreach ($roles as $key => $role)
                  @php
    $rolePermissions = $role->permissions->pluck('id')->toArray();
  @endphp
                    <tr class="text-center">
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $role->name }}</td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="icon-base ti tabler-dots-vertical"></i>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal{{ $role->id }}">
                              <i class="icon-base ti tabler-pencil me-1"></i> Edit
                            </a>
                            <!-- <a class="dropdown-item" href="{{ route('roles.roles', $role->id) }}" onclick="return confirm('Are you sure you want to delete ?');">
                              <i class="icon-base ti tabler-trash me-1"></i> Delete
                            </a> -->
                            <a class="dropdown-item" href="{{ route('roles.roles', $role->id) }}" data-delete>
    <i class="icon-base ti tabler-trash me-1"></i> Delete
</a>

                          </div>
                        </div>
                      </td>
                    </tr>

                    <!-- Edit Role Modal -->
                    <div class="modal fade" id="editModal{{ $role->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $role->id }}" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" style="max-width: 70%;">
                        <div class="modal-content">
                          <form action="{{ url('roles/'.$role->id) }}" id="EditForm{{ $role->id }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                              <h5 class="modal-title" id="editModalLabel{{ $role->id }}">Update Details</h5>
                             <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                               -->
                            </div>

                            <div class="modal-body">
                              <div class="mb-12">
                                <strong>Name:</strong>
                                <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $role->name }}">
                              </div>

                              <div class="mb-3">
  <label for="permissions" class="form-label"><strong>Permissions:</strong></label>

  <!-- Toggle Switch -->
  <div class="d-flex justify-content-end mb-2">
    <div class="form-check form-switch">
      <input class="form-check-input select-all-toggle" type="checkbox" id="selectAllToggle{{ $role->id }}">
      <label class="form-check-label" for="selectAllToggle{{ $role->id }}">Select All</label>
    </div>
  </div>

  <!-- Permission Checkboxes -->
  <div class="row">
    @foreach($permission as $perm)
      <div class="col-md-4 mb-2">
        <div class="form-check form-switch">
          <input class="form-check-input permission-checkbox-{{ $role->id }}"
                 type="checkbox"
                 name="permission[]"
                 value="{{ $perm->id }}"
                 id="perm{{ $role->id }}_{{ $perm->id }}"
                 {{ in_array($perm->id, $rolePermissions) ? 'checked' : '' }}>
          <label class="form-check-label" for="perm{{ $role->id }}_{{ $perm->id }}">
            {{ $perm->name }}
          </label>
        </div>
      </div>
    @endforeach
  </div>
</div>

                            </div>

                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <button type="submit" form="EditForm{{ $role->id }}" class="btn btn-primary">Save Changes</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          @if(isset($openModal) && $openModal)
            <script>
              window.onload = function () {
                var editModal = new bootstrap.Modal(document.getElementById('editModal'));
                editModal.show();
              };
            </script>
          @endif
        </div>
      </div>
      <!--/ Role cards -->

      <!-- Add Role Modal -->
      <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-add-new-role">
          <div class="modal-content">
          
            <div class="modal-body">
                <div class="text-center mb-6">
                   <h4 class="role-title">Add New Role</h4>
                   <p class="text-body-secondary">Set role permissions</p>
                </div>

              <!-- Add role form -->
              <form id="addRoleForm" method="POST" action="{{ route('roles.store') }}" class="row g-3">
                @csrf
                <div class="col-12 form-control-validation mb-3">
                <h5 class="mb-6 d-flex justify-content-between">
                Role Name</h5>
                  <input type="text" id="modalRoleName" name="name" class="form-control" placeholder="Enter a role name" tabindex="-1" />
                </div>

                <!-- <div class="col-12">
                  <h5 class="mb-6">Role Permissions</h5>
                  <strong>Permission:</strong><br/>
                  <button type="button" class="btn btn-secondary mb-3" id="selectAllPermissions">Select All Permissions</button>
                  @foreach($permission as $perm)
  <label>
    <input type="checkbox" name="permission[]" value="{{ $perm->id }}">
    {{ $perm->name }}
  </label><br/>
@endforeach
                </div> -->
                <div class="col-12">
  <h5 class="mb-4 d-flex justify-content-between align-items-center">
    Role Permissions

    <!-- Select All Toggle Switch -->
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" id="selectAllToggle">
      <label class="form-check-label" for="selectAllToggle">Select All</label>
    </div>
  </h5>

  <!-- Permissions Checkboxes -->
  @foreach($permission as $perm)
    <div class="form-check">
      <input class="form-check-input permission-checkbox" type="checkbox" name="permission[]" value="{{ $perm->id }}" id="create-perm{{ $perm->id }}">
      <label class="form-check-label" for="create-perm{{ $perm->id }}">
        {{ $perm->name }}
      </label>
    </div>
  @endforeach
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

<!-- JavaScript to Select All Permissions -->
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

<script>
  document.getElementById('selectAllToggle').addEventListener('change', function() {
    const isChecked = this.checked;
    const checkboxes = document.querySelectorAll('.permission-checkbox');

    checkboxes.forEach(function(checkbox) {
      checkbox.checked = isChecked;
    });
  });
</script>




                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-primary btn-sm mt-2 mb-3">
                    <i class="fa-solid fa-floppy-disk"></i> Submit
                  </button>
                </div>
              </form>
              <!--/ Add role form -->
            </div>
          </div>
        </div>
      </div>
      <!--/ Add Role Modal -->

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


    <!-- / Content -->

    <!-- Footer -->
    @extends('layout.footer')
  </div>
</div>

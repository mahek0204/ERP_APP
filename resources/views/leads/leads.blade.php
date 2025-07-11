@extends('layout.header')

<div class="layout-page">
  <div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
      
      <!-- Offcanvas for Adding New Record -->
      <div class="card">
        <div class="offcanvas offcanvas-end" id="add-new-record">
          <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">New Record</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>

          <div class="offcanvas-body flex-grow-1">
            <form class="add-new-record pt-0 row g-2" method="post" action="">
              @csrf

              <div class="col-sm-12 form-control-validation">
                <label class="form-label">Leads Name</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text"><i class="icon-base ti tabler-user"></i></span>
                  <input type="text" class="form-control dt-full-name" name="name" placeholder="John Doe" aria-label="John Doe" />
                </div>
              </div>

              <div class="col-sm-12 form-control-validation">
                <label class="form-label">Email</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text"><i class="icon-base ti tabler-user"></i></span>
                  <input type="text" class="form-control dt-email" name="email" placeholder="john.doe@example.com" aria-label="john.doe@example.com" />
                </div>
              </div>

              <div class="col-sm-12 form-control-validation">
                <label class="form-label">Number</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text"><i class="icon-base ti tabler-user"></i></span>
                  <input type="number" class="form-control dt-number" name="number" placeholder="1234567890" aria-label="1234567890" />
                </div>
              </div>

              <div class="col-sm-12 form-control-validation">
                <label class="form-label">Source</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text"><i class="icon-base ti tabler-user"></i></span>
                  <input type="text" class="form-control dt-source" name="source" placeholder="Referral" aria-label="Referral" />
                </div>
              </div>

              <div class="col-sm-12 form-control-validation">
                <label class="form-label">Company Name</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text"><i class="icon-base ti tabler-user"></i></span>
                  <input type="text" class="form-control dt-company" name="cname" placeholder="Acme Corp" aria-label="Acme Corp" />
                </div>
              </div>

              <div class="col-sm-12 form-control-validation">
                <label class="form-label">Status</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text"><i class="icon-base ti tabler-user"></i></span>
                  <select name="status" class="form-select">
                    <option value="New">New</option>
                    <option value="Open">Open</option>
                    <option value="Closed">Closed</option>
                  </select>
                </div>
              </div>

              <div class="col-sm-12">
                <button type="submit" class="btn btn-primary data-submit me-sm-4 me-1">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
              </div>
            </form>
          </div>
        </div>

        <!-- Table Section -->
        <div class="card-datatable text-nowrap">
          <div class="row card-header flex-column flex-md-row mx-0 px-3">
            <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto me-auto mt-0">
              <h5 class="card-title mb-0 text-md-start text-center pb-md-0 pb-6">Leads Detail</h5>
            </div>  
            <div class="d-md-flex justify-content-between align-items-center dt-layout-end col-md-auto ms-auto mt-0">
              <div class="dt-buttons btn-group flex-wrap mb-0">
                <div class="btn-group">
                  <button class="btn buttons-collection btn-label-primary dropdown-toggle me-4" type="button">
                    <span class="d-flex align-items-center gap-2">
                      <span class="d-none d-sm-inline-block">Export</span>
                    </span>
                  </button>
                  <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="offcanvas" data-bs-target="#add-new-record">
                    <i class="icon-base ti tabler-plus icon-sm"></i>
                    <span class="d-none d-sm-inline-block">Add New Record</span>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <br>

          <table class="dt-complex-header table table-responsive">
            <thead class="table-active text-center">
              <tr>
                <th>Sr No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Number</th>
                <th>Source</th>
                <th>Company Name</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody class="table-border-bottom-0">
              @php $i = 1; @endphp
              @foreach($result as $data)
              <tr class="text-center">
                <td>{{ $i++ }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->number }}</td>
                <td>{{ $data->source }}</td>
                <td>{{ $data->company_name }}</td>
                <td>
                  @if ($data->status === 'New')
                    <span class="badge bg-label-primary me-1">New</span>
                  @elseif ($data->status === 'Open')
                    <span class="badge bg-label-success me-1">Open</span>
                  @elseif ($data->status === 'Closed')
                    <span class="badge bg-label-danger me-1">Closed</span>
                  @endif
                </td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="icon-base ti tabler-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="/lead/{{ $data->id }}" data-bs-toggle="modal" data-bs-target="#editModal{{ $data->id }}">
                        <i class="icon-base ti tabler-pencil me-1"></i> Edit
                      </a>
                      <!-- <a class="dropdown-item" href="/delete/{{ $data->id }}" onclick="return confirm('Are you sure you want to delete ?');">
                        <i class="icon-base ti tabler-trash me-1"></i> Delete
                      </a> -->
                      <a class="dropdown-item" href="/delete/{{ $data->id }}" data-delete>
                         <i class="icon-base ti tabler-trash me-1"></i> Delete
                      </a>
                    </div>
                  </div>
                </td>
              </tr>

              @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif

              <!-- Edit Modal -->
              <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $data->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 70%;">
                  <div class="modal-content">
                    <form action="{{ url('lead/' . $data->id) }}" id="EditForm{{ $data->id }}" method="post">
                      @csrf
                      @method('PUT')

                      <div class="modal-header">
                        <h5 class="modal-title">Update Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <div class="modal-body">
                        <div class="mb-12">
                          <label class="form-label">Leads Name</label>
                          <input type="text" class="form-control" name="name" value="{{ $data->name }}" required>
                        </div>

                        <div class="mb-12">
                          <label class="form-label">Email</label>
                          <input type="email" class="form-control" name="email" value="{{ $data->email }}" required>
                        </div>

                        <div class="mb-12">
                          <label class="form-label">Number</label>
                          <input type="number" class="form-control" name="number" value="{{ $data->number }}" required>
                        </div>

                        <div class="mb-12">
                          <label class="form-label">Source</label>
                          <input type="text" class="form-control" name="source" value="{{ $data->source }}" required>
                        </div>

                        <div class="mb-12">
                          <label class="form-label">Company Name</label>
                          <input type="text" class="form-control" name="cname" value="{{ $data->company_name }}" required>
                        </div>

                        <div class="mb-12">
                          <label class="form-label">Status</label>
                          <select name="status" class="form-select">
                            <option value="New" {{ $data->status == 'New' ? 'selected' : '' }}>New</option>
                            <option value="Open" {{ $data->status == 'Open' ? 'selected' : '' }}>Open</option>
                            <option value="Closed" {{ $data->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                          </select>
                        </div>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
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

      @if(isset($openModal) && $openModal)
      <script>
        window.onload = function () {
          var editModal = new bootstrap.Modal(document.getElementById('editModal'));
          editModal.show();
        };
      </script>
      @endif

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

    </div>
  </div>
</div>

@extends('layout.footer')

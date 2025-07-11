@extends('layout.header')

<!-- Content wrapper -->
<div class="layout-page">
  <div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

      <!-- Card -->
      <div class="card">
        <div class="row card-header flex-column flex-md-row border-bottom mx-0 px-3">
          <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto me-auto mt-0">
            <h5 class="card-title mb-0 text-md-start text-center pb-md-0 pb-6">Team Management</h5>
          </div>
          <div class="text-end">
            <button class="btn buttons-collection btn-label-primary dropdown-toggle me-4" type="button">
              <span><i class="icon-base ti tabler-upload icon-xs me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span></span>
            </button>

            <button class="btn btn-primary ms-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#add-new-record">
              <i class="icon-base ti tabler-plus icon-sm"></i>
              <span class="d-none d-sm-inline-block">Add New Record</span>
            </button>
          </div>
        </div>

        <!-- Modal to add new record -->
        <div class="offcanvas offcanvas-end" id="add-new-record">
          <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">Create New Team</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body flex-grow-1">
            <form action="{{ route('team.store') }}" method="POST" class="add-new-record row g-2">
              @csrf

              <div class="col-sm-12">
                <label class="form-label">Team Name</label>
                <input type="text" name="team_name" class="form-control" placeholder="Enter team name" required>
              </div>

              <div class="col-sm-12">
                <label class="form-label">Team Leader</label>
                
                <select name="team_leader_id" class="form-select" required>
  @foreach ($teamLeaders as $leader)
    <option value="{{ $leader->id }}">{{ $leader->name }}</option>
  @endforeach
</select>

              </div>

              <div class="col-sm-12">
                <label class="form-label">Team Members</label>
                
                 @foreach ($teamMembers as $member)
  <div class="form-check">
    <input type="checkbox" class="form-check-input" name="team_member_ids[]" value="{{ $member->id }}" id="member-{{ $member->id }}">
    <label class="form-check-label" for="member-{{ $member->id }}">{{ $member->name }}</label>
  </div>
@endforeach

              </div>

              <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
              </div>
            </form>
          </div>
        </div>

        <!-- Table to display teams -->
        <div class="table-responsive text-nowrap">
          <table class="table table-borderless">
            <thead class="table-active text-center">
              <tr>
                <th>SR NO.</th>
                <th>TEAM NAME</th>
                <th>TEAM LEADER</th>
                <th>TEAM MEMBERS</th>
                 <th>ACTION</th>
              </tr>
            </thead>
            <tbody class="text-center">
              @foreach($teams as $index => $team)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $team->team_name }}</td>
                <td>{{ $team->teamLeader->name ?? 'N/A' }}</td>
               
                <td>
  @foreach (json_decode($team->team_member_ids, true) as $memberId)
    @if ($memberId != $team->team_leader_id)
             @php
    $member = $teamMembers->firstWhere('id', $memberId) ?? $teamLeaders->firstWhere('id', $memberId);
@endphp

      @if ($member)
        <span class="badge bg-label-info me-1">{{ $member->name }}</span>
      @endif
    @endif
  @endforeach
</td>
<td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="icon-base ti tabler-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="/team/{{ $team->id }}" data-bs-toggle="modal" data-bs-target="#editModal{{ $team->id }}">
                        <i class="icon-base ti tabler-pencil me-1"></i> Edit
                      </a>
                      <a class="dropdown-item" href="/team/destroy/{{ $team->id }}" onclick="return confirm('Are you sure you want to delete ?');">
                        <i class="icon-base ti tabler-trash me-1"></i> Delete
                      </a>

                      
                    </div>
                  </div>
                </td>

              </tr>

              
<td> 
@if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif

              <!-- Edit Modal -->

              <div class="modal fade" id="editModal{{ $team->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $team->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 70%;">
                  <div class="modal-content">
                    <form action="{{ url('team/'.$team->id) }}" id="EditForm{{$team->id}}" method="post">
                      @csrf
                      @method('PUT')

                      <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $team->id }}">Update Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <div class="modal-body">
                        <div class="mb-12">
                          <label for="editName" class="form-label">Team Name</label>
                          <input
                            type="text"
                            class="form-control"
                            id="editName"
                            name="team_name"
                            value="{{ old('team_name', $team->team_name) }}"
                            required
                          />
                        </div>

                      <div class="mb-12">
                        <label class="form-label">Team Leader</label>
                        <select name="team_leader_id" class="form-select" required>
                        @foreach ($teamLeaders as $leader)
                          <option value="{{ $leader->id }}">{{ $leader->name }}</option>
                        @endforeach
                        </select>
                      </div>

              <!-- <div class="md-12">
                  <label class="form-label">Team Members</label>
                @foreach ($teamMembers as $member)
                
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" name="team_member_ids[]" value="{{ $member->id }}" id="member-{{ $member->id }}">
                  <label class="form-check-label" for="member-{{ $member->id }}">{{ $member->name }}</label>
                </div>

              </div>
                @endforeach -->
                <div class="mb-3">
  <label class="form-label">Team Members</label>
  <div class="row">
    @foreach ($teamMembers as $member)
      <div class="col-6 col-md-3"> <!-- 4 per row -->
        <div class="form-check">
          <input type="checkbox" class="form-check-input" name="team_member_ids[]" value="{{ $member->id }}" id="member-{{ $member->id }}">
          <label class="form-check-label" for="member-{{ $member->id }}">{{ $member->name }}</label>
        </div>
      </div>
    @endforeach
  </div>
</div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" form="EditForm{{ $team->id }}" class="btn btn-primary">Save Changes</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- End Table -->
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
</div>

@extends('layout.footer')  
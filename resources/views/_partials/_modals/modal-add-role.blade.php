<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-add-new-role">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="role-title mb-2">Add New Role</h4>
                    <p>Set role permissions</p>
                </div>
                <!-- Add role form -->
                <form method="POST" action="roles" class="row g-6">
                    @csrf
                    <div class="col-12">
                        <label class="form-label" for="roleName">Role Name</label>
                        <input type="text" id="roleName" name="role_name" class="form-control" placeholder="Enter a role name" tabindex="-1" required />
                    </div>
                    <div class="col-12">
                        <h5 class="mb-6">Role Permissions</h5>
                        <!-- Permission table -->
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap fw-medium text-heading">
                                            Administrator Access
                                            <i class="ti ti-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system"></i>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="checkbox" id="selectAll" />
                                                    <label class="form-check-label" for="selectAll"> Select All </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @foreach ($permissions->chunk(4) as $chunk)
                                        <tr>
                                            @php
                                                $firstPermission = $chunk->first();
                                                $words = explode(' ', $firstPermission->name);
                                                $firstWord = $words[0] ?? '';
                                            @endphp
                                            <td class="text-nowrap fw-medium text-heading">{{ ucwords($firstWord) }} <i class="ti ti-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system"></i></td>
                                            @foreach ($chunk as $permission)
                                                @php
                                                    $words = explode(' ', $permission->name);
                                                    $name = $words[1] ?? '';
                                                @endphp
                                                <td>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="form-check mb-0">
                                                            <input class="form-check-input" name="permission[]" value="{{ $permission->id }}" type="checkbox" id="select{{ $permission->id }}" />
                                                            <label class="form-check-label" for="select{{ $permission->id }}">
                                                                {{ ucwords($name) }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Permission table -->
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-3">Submit</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                </form>

                <!--/ Add role form -->
            </div>
        </div>
    </div>
</div>
<!--/ Add Role Modal -->

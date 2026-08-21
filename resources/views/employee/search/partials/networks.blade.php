                <div class="table-responsive">
                    <table id="basic-datatable" class="table table-hover table-striped dt-responsive nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Network Title</th>
                                <th>Status</th>
                                <th>Audit Info</th>
                                <th>created /updated</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($networks as $network)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="fw-semibold">{{ $network->name }}</span>
                                </td>
                                <td>
                                    @if($network->status == 1)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times-circle me-1"></i> Inactive
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-column small">
                                        <span class="text-muted">
                                            <i class="fas fa-user-plus me-1"></i>
                                            {{ $network->user->name ?? 'N/A'}}
                                        </span>
                                        <span class="text-muted">
                                            <i class="fas fa-user-edit me-1"></i>
                                            {{ $network->updatedUser->name ?? 'N/A'}}
                                        </span>
                                    </div>
                                </td>
                              <td>
                                        <small>Created: {{ $network->created_at->format('Y-m-d H:i') }}</small><br>
                                        <small>Updated: {{ $network->updated_at->format('Y-m-d H:i') }}</small>
                                    </td>

                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('employee.network.edit', $network->id) }}"
                                           class="btn btn-outline-primary rounded-start"
                                           data-bs-toggle="tooltip" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('employee.network.destroy', $network->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this network?')"
                                                    class="btn btn-outline-danger rounded-end"
                                                    data-bs-toggle="tooltip" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                            @if(isset($networks) && method_exists($networks, 'links'))
                            <div class="mt-3">
                            {{ $networks->links('vendor.pagination.bootstrap-5') }}
                            </div>
                            @endif
                </div>
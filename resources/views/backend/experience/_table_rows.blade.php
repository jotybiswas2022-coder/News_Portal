@forelse($experiences as $exp)
    <tr>
        <td class="ps-4 fw-semibold text-muted">{{ $loop->iteration }}</td>
        <td class="fw-semibold">
            {{ $exp->company }}
            @if($exp->is_current)
                <span class="badge rounded-pill px-2 py-1 ms-1" style="background:rgba(16,185,129,0.12); color:#059669; font-size:0.6rem; font-weight:600;">Current</span>
            @endif
        </td>
        <td>{{ $exp->position }}</td>
        <td class="small text-muted">{{ $exp->duration }}</td>
        <td class="small text-muted">{{ $exp->location ?: '—' }}</td>
        <td><span class="badge rounded-pill px-3 py-1" style="background:#f1f5f9; color:#475569; font-weight:500;">{{ $exp->sort_order }}</span></td>
        <td>
            <a href="{{ route('admin.experiences.toggleStatus', $exp->id) }}"
               class="badge rounded-pill px-3 py-1 text-decoration-none status-badge {{ $exp->is_active ? 'active-badge' : 'inactive-badge' }}"
               data-title="{{ $exp->company }}">
                {{ $exp->is_active ? 'Active' : 'Inactive' }}
            </a>
        </td>
        <td>
            <div class="d-flex gap-1">
                <a href="{{ route('admin.experiences.edit', $exp->id) }}"
                   class="btn btn-sm btn-outline-primary rounded-3 px-2">
                    <i class="bi bi-pencil"></i>
                </a>
                <button type="button"
                        class="btn btn-sm btn-outline-danger rounded-3 px-2 delete-btn"
                        data-id="{{ $exp->id }}"
                        data-title="{{ $exp->company }}">
                    <i class="bi bi-trash"></i>
                </button>
                <form id="delete-form-{{ $exp->id }}"
                      action="{{ route('admin.experiences.destroy', $exp->id) }}"
                      method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="8" class="text-center py-5">
            <div class="empty-state">
                <i class="bi bi-search" style="font-size:2rem; color:#94a3b8; display:block; margin-bottom:0.5rem;"></i>
                <div class="fw-semibold mb-2">No Experiences Found</div>
                <p class="text-muted small">Try adjusting your search terms.</p>
            </div>
        </td>
    </tr>
@endforelse

@extends('layouts.admin')

@section('title', 'Support - Admin Panel')

@section('content')
<h3 class="mb-4">🎧 Support Tickets</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card p-3">
  <table class="table table-hover">
    <thead class="table-success">
      <tr>
        <th>#</th>
        <th>Subject</th>
        <th>From</th>
        <th>Status</th>
        <th>Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($tickets as $ticket)
        <tr>
          <td>{{ $ticket->SupportID }}</td>
          <td>
            <div class="fw-semibold">{{ htmlspecialchars($ticket->Subject) }}</div>
            <small class="text-muted d-block" style="max-width:500px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
              {{ htmlspecialchars($ticket->Message) }}
            </small>
          </td>
          <td>
            {{ $ticket->user ? htmlspecialchars($ticket->user->FullName) : 'Guest' }}<br>
            <small class="text-muted">{{ $ticket->user ? htmlspecialchars($ticket->user->Email) : '-' }}</small>
          </td>
          <td>
            <span class="badge {{ $ticket->Status === 'Open' ? 'bg-warning' : 'bg-success' }}">
              {{ htmlspecialchars($ticket->Status) }}
            </span>
          </td>
          <td>{{ $ticket->CreatedAt->format('d-M-Y H:i') }}</td>
          <td>
            <form action="{{ route('admin.support.toggleStatus', $ticket->SupportID) }}" method="POST" style="display:inline;">
              @csrf
              @method('PATCH')
              <button type="submit" class="btn btn-sm btn-outline-success">
                {{ $ticket->Status === 'Open' ? 'Close' : 'Reopen' }}
              </button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="6" class="text-center text-muted">No tickets</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection

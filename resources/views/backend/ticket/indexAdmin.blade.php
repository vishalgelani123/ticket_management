@extends('backend.layouts.app')
@section('title') Tickets @endsection
@section('content')
    <style>
        .btn-info {
            display: none;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-12 mb-4">
                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('error'))
                    <div class="alert alert-danger">{{Session::get('error')}}</div>
                @endif
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><span class="fa fa-filter"></span>&nbsp;Filter</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tickets.admin') }}" method="get">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="status_filter">Status</label>
                                    <select name="status_filter" id="status_filter" class="form-control">
                                        <option value="">All</option>
                                        <option
                                            value="open" {{ request('status_filter') === 'open' ? 'selected' : '' }}>
                                            Open
                                        </option>
                                        <option
                                            value="closed" {{ request('status_filter') === 'closed' ? 'selected' : '' }}>
                                            Closed
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="category_filter">Category</label>
                                    <select name="category_filter" id="category_filter" class="form-control">
                                        <option value="">All</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ request('category_filter') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary mt-6">Apply Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><span class="fa fa-ticket"></span>&nbsp;Tickets</div>
                    </div>
                    <div class="card-body">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="statusChangeModal" tabindex="-1" aria-labelledby="statusChangeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusChangeModalLabel">Change Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="statusSelect" class="form-label">Select Status:</label>
                    <select class="form-select" id="statusSelect">
                        <option value="open">Open</option>
                        <option value="close">Close</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmStatusChange">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ticketDetailsModal" tabindex="-1" aria-labelledby="ticketDetailsModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ticketDetailsModalLabel">Ticket Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <h6>Title:</h6>
                                    <p id="ticketTitle"></p>
                                </div>
                                <div class="col-6">
                                    <h6>Description:</h6>
                                    <p id="ticketDescription"></p>
                                </div>
                                <div class="col-6">
                                    <h6>Status:</h6>
                                    <p id="ticketStatus"></p>
                                </div>
                                <div class="col-6">
                                    <h6>Category:</h6>
                                    <p id="ticketCategory"></p>
                                </div>
                                <div class="col-6">
                                    <h6>Ticket Reply:</h6>
                                    <p id="ticketReply"></p>
                                </div>
                                <div class="col-6">
                                    <h6>Created At:</h6>
                                    <p id="ticketCreatedAt"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Modal for Ticket Reply -->
    <div class="modal fade" id="ticketReplyModal" tabindex="-1" aria-labelledby="ticketReplyModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ticketReplyModalLabel">Ticket Reply</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ticketIdInput" id="ticketIdInput">
                    <textarea id="ticketReplyText" class="form-control" rows="4"
                              placeholder="Enter your reply"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitReply">Reply</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    {!! $dataTable->scripts() !!}
    <script>
        $('#statusSelect').select2();
        $('#status_filter').select2();
        $('#category_filter').select2();
        $(document).on('click', '.toggle-status', function () {
            let userId = $(this).data('user_id');
            let newStatus = $(this).data('status');
            $('#confirmStatusChange').data('user_id', userId);
            $('#statusChangeModal').modal('show');
        });

        $(document).on('click', '#confirmStatusChange', function () {
            let userId = $(this).data('user_id');
            let newStatus = $('#statusSelect').val(); // Get selected status from select box

            // Perform the AJAX request to update the user's status
            $.ajax({
                type: 'POST',
                url: '{{ route('tickets.update-status') }}',
                data: {
                    user_id: userId,
                    status: newStatus,
                    _token: '{{ csrf_token() }}'
                },
                success: function (data) {
                    console.log('Response:', data);

                    // Close the modal
                    $('#statusChangeModal').modal('hide');

                    // Reload the datatable to reflect the updated status
                    $('#tickets-table').DataTable().ajax.reload();
                },
                error: function (xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        });

        $(document).on('click', '.view-details', function () {
            let userId = $(this).data('user_id');
            // Fetch ticket details using AJAX (replace with your logic)
            $.ajax({
                type: 'GET',
                url: '{{ route('tickets.get-details') }}',
                data: {
                    user_id: userId,
                    _token: '{{ csrf_token() }}'
                },
                success: function (data) {
                    // Populate modal with ticket details
                    $('#ticketTitle').text(data.title);
                    $('#ticketDescription').text(data.description);
                    $('#ticketStatus').text(data.status);
                    $('#ticketCategory').text(data.category);
                    $('#ticketCreatedAt').text(data.created_at);
                    $('#ticketReply').text(data.ticket_reply);

                    // Show the modal
                    $('#ticketDetailsModal').modal('show');
                },
                error: function (xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        });

        $(document).ready(function () {
            $(document).on('click', '.ticket_reply', function () {
                const ticketId = $(this).data('ticket_id');
                $('#ticketReplyModal').modal('show'); // Open the modal

                // Store the ticket ID in a hidden input field
                $('#ticketIdInput').val(ticketId);
            });

            $('#submitReply').on('click', function () {
                const ticketId = $('#ticketIdInput').val();
                const replyText = $('#ticketReplyText').val();

                if (!replyText.trim()) {
                    alert('Please enter your reply.');
                    return;
                }
                $.ajax({
                    method: 'POST',
                    url: '{{ route('tickets.send-mail') }}',
                    data: {
                        ticket_id: ticketId,
                        reply: replyText,
                        _token: '{{ csrf_token() }}'

                    },
                    success: function (response) {
                        if (response.success) {
                            $('#ticketReplyModal').modal('hide'); // Close the modal
                            $('#ticketReplyText').val('');
                            $('#tickets-table').DataTable().ajax.reload();
                        } else {
                            alert('Error sending email.');
                        }
                    },
                    error: function () {
                        alert('An error occurred while sending the email.');
                    }
                });
            });
        });


    </script>
@endpush

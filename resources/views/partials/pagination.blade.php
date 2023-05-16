<div class="row">
    <div class="col-sm-12 col-md-4">
        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
            {{ __('Showing page') }} {{ $data->currentPage() }} of {{ $data->lastPage() }}
        </div>
    </div>
    @if($data->total() > $data->perPage())
        <div class="col-sm-12 col-md-8">
            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                <ul class="pagination">
                    @if(!$data->onFirstPage())
                        <li class="paginate_button page-item previous" id="DataTables_Table_0_previous">
                            <a href="{{ $data->previousPageUrl() }}" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                        </li>
                    @endif


                    <li class="paginate_button page-item active">
                        <a href="#" aria-controls="DataTables_Table_ disabled0" data-dt-idx="1" tabindex="0" class="page-link">{{ $data->currentPage() }}</a>
                    </li>

                    @if($data->hasMorePages())
                        <li class="paginate_button page-item next" id="DataTables_Table_0_next">
                            <a href="{{ $data->nextPageUrl() }}" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0" class="page-link">Next</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    @endif
</div>

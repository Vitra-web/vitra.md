@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="">
{{--            <div>--}}
{{--                <p class="text-sm text-gray-700 leading-5 dark:text-gray-400">--}}
{{--                    {!! __('Showing') !!}--}}
{{--                    @if ($paginator->firstItem())--}}
{{--                        <span class="font-medium">{{ $paginator->firstItem() }}</span>--}}
{{--                        {!! __('to') !!}--}}
{{--                        <span class="font-medium">{{ $paginator->lastItem() }}</span>--}}
{{--                    @else--}}
{{--                        {{ $paginator->count() }}--}}
{{--                    @endif--}}
{{--                    {!! __('of') !!}--}}
{{--                    <span class="font-medium">{{ $paginator->total() }}</span>--}}
{{--                    {!! __('results') !!}--}}
{{--                </p>--}}
{{--            </div>--}}

            <div>
                <span class="pagination-container">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
{{--                            <p class="pagination-prev">{{trans('labels.previous')}}</p>--}}
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pagination-prev" aria-label="{{ __('pagination.previous') }}">
                            <svg style="transform:rotate(180deg);" fill="#000000" width="15px" height="15px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="38.4" ><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M526.299 0 434 92.168l867.636 867.767L434 1827.57l92.299 92.43 959.935-960.065z" fill-rule="evenodd"></path> </g></svg>
                            <p>{{trans('labels.previous')}}</p>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span class="page active">{{ $page }}</span>
                                @elseif ($page == 1 || $page == $paginator->lastPage() || ($page >= $paginator->currentPage() - 2 && $page <= $paginator->currentPage() + 2))
                                    <a href="{{ $url }}" class="page">{{ $page }}</a>
                                @elseif ($page == $paginator->currentPage() - 3 || $page == $paginator->currentPage() + 3)
                                    <span class="page ellipsis">. . .</span>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pagination-next" aria-label="{{ __('pagination.next') }}">
                            <p>{{trans('labels.next')}}</p>
                            <svg fill="#000000" width="15px" height="15px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="38.4"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M526.299 0 434 92.168l867.636 867.767L434 1827.57l92.299 92.43 959.935-960.065z" fill-rule="evenodd"></path> </g></svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
{{--                            <p class="pagination-next">{{trans('labels.next')}}</p>--}}
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif

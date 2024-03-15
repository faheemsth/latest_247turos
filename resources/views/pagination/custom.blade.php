<style>
    .pager {
        display: inline-block;
        padding-left: 0;
        margin: 20px 0;
        border-radius: 20px; /* Increased border radius for smoother edges */
    }

    .pager li {
        display: inline;
    }

    .pager li a,
    .pager li span {
        position: relative;
        float: left;
        padding: 10px 20px !important; /* Increased padding for better readability */
        margin-left: -1px;
        line-height: 1.6; /* Increased line height for better vertical spacing */
        color: #337ab7;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
        transition: all 0.3s ease; /* Added smooth transition effect */
    }

    .pager li.active span {
        background-color: #337ab7;
        color: #fff;
        border-color: #337ab7;
        padding: 10px 20px !important; /* Keep padding consistent for active button */
    }

    .pager li:first-child a,
    .pager li:first-child span {
        margin-left: 0;
        border-top-left-radius: 20px; /* Adjusted border radius */
        border-bottom-left-radius: 20px; /* Adjusted border radius */
    }

    .pager li:last-child a,
    .pager li:last-child span {
        border-top-right-radius: 20px; /* Adjusted border radius */
        border-bottom-right-radius: 20px; /* Adjusted border radius */
    }

    .pager li.disabled span {
        color: #777;
        cursor: not-allowed;
        background-color: #eee;
        border-color: #ddd;
    }

    /* Hover effect for links */
    .pager li a:hover {
        background-color: #f5f5f5;
        border-color: #ccc;
    }
</style>


@if($paginator->hasPages())
<ul class="pager">
    @if ($paginator->onFirstPage())
    <li class="disabled"><span>← Previous</span></li>
    @else
    <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">← Previous</a></li>
    @endif
    @foreach ($elements as $element)
    @if (is_string($element))
    <li class="disabled"><span>{{ $element }}</span></li>
    @endif
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <li class="active my-active"><span>{{ $page }}</span></li>
    @else
    <li><a href="{{ $url }}">{{ $page }}</a></li>
    @endif
    @endforeach
    @endif
    @endforeach
    @if ($paginator->hasMorePages())
    <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next →</a></li>
    @else
    <li class="disabled"><span>Next →</span></li>
    @endif
</ul>
@endif

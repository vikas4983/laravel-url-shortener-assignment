 <nav class="bg-light p-2 rounded" style="--bs-breadcrumb-divider: '';  text-decoration:none;" aria-label="breadcrumb">
     <ol class="breadcrumb mb-0">
         <li class="breadcrumb-item">
            <a href="{{ $homeRoute['url'] }}">{{ $homeRoute['name'] }}</a>
        </li>
        @isset($parentRoute)
            <li class="breadcrumb-item">
                <a href="{{ $parentRoute['url'] ?? '#' }}">{{ $parentRoute['name'] }}</a>
            </li>
        @endisset
        
        <li class="breadcrumb-item active" aria-current="page">
            {{ $currentRoute['name'] }}
        </li>
     </ol>
 </nav>


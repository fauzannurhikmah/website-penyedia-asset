<div class="jumbotron text-center" style="margin-top: -30px;background: url('/img/assets/banner.jpg'); background-size: cover;">
    <h1 class="display-4">Create your own limits</h1>
    <p class="lead">Gain access to over +100,000 <span class="text-warning"><i class="fas fa-crown"></i> Premium</span> resources </p>
    @if (request()->routeIs('subcription'))
        <p class="font-weight-bold">Download whatever, cancel whenever</p>
    @else
        <a href="{{route('subcription')}}" class="btn btn-lg btn-custom font-weight-bold">Go Premium</a>
    @endif
</div>
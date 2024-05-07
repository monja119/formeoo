<style>
    card {
        transition: all 0.3s ease-in-out;
    }
</style>
<div class="col-12">
    @can('admin')
        <div class="row mt-3">
            <div class="col-2">
                <a href="/module/new">
                    <input type="button" id="create_module" class="btn text-white bg-main-color rounded" value="Nouveau" />
                </a>
            </div>
        </div>
    @endcan
    <hr>
    @foreach($modules as $module)
        <a href="{{ Route('show.module', ['id'=>$module->id]) }}">
            <div class="row animation-fade-in animation-duration-1">
                <div class="col-3">
                    <span class="card-title fw-bold main-color"> {{ $module->titre }} </span>
                </div>
                 <div class="col-9">
                    <p class="small opacity-75"> {{ $module->description }} </p>
                </div>
            </div>
            <hr>
        </a>
    @endforeach
</div>




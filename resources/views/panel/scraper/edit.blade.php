@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-3">
                <a href="{{route('scraper')}}" class="btn btn-secondary" >
                    <i class="fas fa-backward mr-2"></i>
                </a>

            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $parser->name}}</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <section class="content">
        <div class="container-fluid ml-4">
            <div class="form_container">
                <form action="{{route('scraper.send', $parser->id)}}" method="post" class="w-100" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="form-group col-lg-3 col-sm-6" data-select2-id="1">
                            <label for="industry">Industrie</label>
                            <select class="custom-select select2 form-control" name="industry_id" id="industry" >
                                @foreach($industries as $item)
                                    <option value="{{$item->id}}" >{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-3 col-sm-6">
                            <label for="category">Categorie</label>
                            <select class="custom-select select2 form-control" name="category_id"  id="category" >

                            </select>
                        </div>
                        <div class="form-group col-lg-3 col-sm-6">
                            <label for="subcategory">Subcategorie</label>
                            <select class="custom-select select2 form-control" name="subcategory_id" id="subcategory" >

                            </select>
                        </div>

                        <div class="form-group col-lg-3 col-sm-6">
                            <label for="url">Url</label>
                            <input type="text" class="form-control" id="url" name="url" placeholder="Furnizore url" value="{{old('url')}}">
                        </div>

                    </div>


                    <div class="form-group text-center d-flex justify-content-center">
                        <input type="submit" class="btn btn-primary" id="saveBtn"  value="Send">
                        <div class="spinner-border text-primary ms-2" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </form>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('script')
    <script>
        const category = document.getElementById('category');
        const subcategory = document.getElementById('subcategory');

        $('.select2').select2()

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        function selectCategory() {
            subcategory.innerHTML = null
            let industryId = $('#industry').find(":selected").val();
            console.log(industryId)

            let industries = {!! json_encode($industriesAll) !!};

            let IndustryList = industries.find(item => item.id == Number(industryId))

            const CategoryList = IndustryList.categories

            if(CategoryList) {
                let options = "";
                //идем по списку девайсов и на каждом создаем очередной option с соответствующими значениями
                CategoryList.forEach(category=> {

                    options += `<option value="${category.id}" >${category.name_ro}</option>`;
                })

                category.innerHTML = options;

            }

            let categories = {!! json_encode($categoriesAll) !!};
            console.log('categories', categories)

            let categoryList = categories.find(item => item.industry_id == Number(industryId))
            console.log('categoryList', categoryList)
            const subCategoryList = categoryList.subcategories

            if(subCategoryList) {
                let options = "";
                //идем по списку девайсов и на каждом создаем очередной option с соответствующими значениями
                subCategoryList.forEach(category=> {
                    options += `<option value="${category.id}" >${category.name_ro}</option>`;
                })

                subcategory.innerHTML = options;
            }
            // selectSubcategory()
        }

        function selectSubcategory() {
            let categoryId = $('#category').find(":selected").val();

            let categories = {!! json_encode($categoriesAll) !!};

            console.log(categories)

            let categoryList = categories.find(item => item.id == Number(categoryId))
            const CategoryList = categoryList.subcategories

            if(CategoryList) {
                let options = "";
                //идем по списку девайсов и на каждом создаем очередной option с соответствующими значениями
                CategoryList.forEach(category=> {
                    options += `<option value="${category.id}" >${category.name_ro}</option>`;
                })

                subcategory.innerHTML = options;
            }
        }

        selectCategory()
        // selectSubcategory()

        $('#industry').on('change', event=>{
            selectCategory()

        })
        $('#category').on('change', event=>{
            selectSubcategory()

        })

        document.getElementById('saveBtn').addEventListener('click', ()=>{
            document.querySelector('.spinner-border').style.display = 'block';
        })
    </script>
@endpush

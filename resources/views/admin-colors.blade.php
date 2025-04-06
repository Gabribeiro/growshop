<x-layout>

    <main id="MainContent" class="main-content">





        @include('menu-mobile')



        <div class="DrawerOverlay"></div>

        <section id="account-layout">

            <h2 class="hide">AccountContent</h2>



            <!-- start account.liquid (TEMPLATE) -->

            @include('admin-bar', ['title' => 'Colors'])





            <div class="account__info-wrapper wrapper">



                <div class="account__address-wrapper"><!-- start snippets/customer-address.liquid -->



                    <table class="account__address-table" style="width: 100%; text-align: center; margin-top: 30px;">

                        <div style="display: flex;">

                            <a href="/account/admin/colors/create"

                                style="display:flex; justify-content: center; color: white; background-color: green;padding-top: 5px;

                                                width: 150px; height: 40px; border-radius: 5px; font-size: 22px;">

                                Add Color

                            </a>

                        </div>





                        <thead>

                            <tr>

                                <th>ID</th>

                                <th>NAME</th>

                                <th>IMAGE</th>

                                <th></th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($colors as $color)

                                <tr>

                                    <td>{{ $loop->index + 1 }}</td>

                                    <td>{{ $color->name }}</td>

                                    <td>

                                        <img src="/storage/color/{{ $color->image }}" alt="Image"

                                            style="width: 100px; height: 100px;">

                                    </td>



                                    <td style="display: flex;">



                                        <a href="/account/admin/colors/{{ $color->id }}" class="edit-color-modal"

                                            aria-valuenow="{{ $color->id }}"

                                            style="color: white; background-color: green;padding-top: 5px;

                                                width: 40px; height: 40px; border-radius: 5px; font-size: 22px;">

                                            <i class='fas fa-edit'></i>

                                        </a>



                                        <div>

                                            <button aria-valueNow="{{ $color->id }}" class="delete-color-modal"

                                                style="color: white; background-color: red;

                                                width: 40px; height: 40px; border-radius: 5px; font-size: 22px;">

                                                <i class='fas fa-trash'></i>

                                            </button>

                                        </div>



                                    </td>

                                </tr>

                            @endforeach

                        </tbody>



                    </table>

                </div>

            </div>



            </div>

            </div>



            <script type="lazyload_int">

 jQuery(document).ready(function ($){

 $('.account__orders-table-row').click(function (){

 window.location = $(this).data('href');

 });

 });

</script>



            <limespot></limespot>

        </section>





    </main>



</x-layout>


<x-layout>
    <main id="MainContent" class="main-content">


        @include('menu-mobile')

        <div class="DrawerOverlay"></div>
        <section id="account-layout">
            <h2 class="hide">AccountContent</h2>

            <!-- start account.liquid (TEMPLATE) -->
            @include('admin-bar', ['title' => 'Reviews'])


            <div class="account__info-wrapper wrapper">

                <div class="account__address-wrapper"><!-- start snippets/customer-address.liquid -->

                    <table class="account__address-table" style="width: 100%; text-align: center; margin-top: 30px;">
                        <div style="display: flex;">
                            <a href="/custom/reviews/create"
                                style="display:flex; justify-content: center; color: white; background-color: green;padding-top: 5px;
                                                width: 150px; height: 40px; border-radius: 5px; font-size: 22px;">
                                Add Review
                            </a>
                        </div>


                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>TITLE</th>
                                <th>COMMENT</th>
                                <th>IMAGE</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $review)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $review->buyer_name }}</td>
                                    <td>{{ $review->buyer_title }}</td>
                                    <td>{{ $review->comment }}</td>
                                    <td>
                                        <img src="/storage/reviews/{{ $review->image }}" alt="Image"
                                            style="width: 100px; height: 100px;">
                                    </td>

                                    <td style="display: flex;">

                                        <a href="/custom/reviews/{{ $review->id }}"
                                            aria-valuenow="{{ $review->id }}"
                                            style="color: white; background-color: green;padding-top: 5px;
                                                width: 40px; height: 40px; border-radius: 5px; font-size: 22px;">
                                            <i class='fas fa-edit'></i>
                                        </a>

                                        <div>
                                            <button aria-valueNow="{{ $review->id }}" class="delete-review-modal"
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

<div style="margin-top: 100px; align-items: center;  text-align: center;">
    <img style="height: 200px;"
        src="{{ asset('img/logo.png') }}" alt="Potiguara Grow">
    <h1 class="rte-h1">Contact Us Form Received</h1>
    <div class="rte">

        <span data-sheets-root="1"
            data-sheets-value='{"1":2,"2":" Expressive Roses, Emotional Connections: \n\nOur mission at Potiguara Grow is to facilitate expressive and emotional connections by harnessing the unparalleled beauty of roses. We dedicate ourselves to perfecting the art of communication with this iconic symbol, making every gesture a heartfelt expression."}'
            data-sheets-userformat='{"2":521,"3":{"1":0},"6":{"1":[{"1":2,"2":0,"5":{"1":2,"2":0}},{"1":0,"2":0,"3":3},{"1":1,"2":0,"4":1}]},"12":0}'
            data-sheets-textstyleruns='{"1":0,"2":{"5":1}}?{"1":41}' data-mce-fragment="1"><strong>
                Welcome to Potiguara Grow world!


            </strong>

            <p>You have received a new contact message:</p>
            <p><strong>Name:</strong> {{ $contact->name }}</p>
            <p><strong>Phone:</strong> {{ $contact->phone }}</p>
            <p><strong>Email:</strong> {{ $contact->email }}</p>
            <p><strong>Message:</strong> {{ $contact->message }}</p>



    </div>
</div>
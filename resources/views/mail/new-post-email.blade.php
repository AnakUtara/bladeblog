<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
</style>

<div style="font-family: sans-serif; display:grid; place-items: center; height: 100dvh">
    <div
        style="border: 2px solid black; padding: 20px 30px; border-radius: 20px; display: flex; flex-direction: column; gap: 10px">
        <h2>Hi {{ $username }},</h2>
        <h4>You have created a new post!</h4>
        <p>
            See your glorious new post:
        </p>
        <a style="text-align: center; width: 100%; background-color: black; color: white; padding: 10px; border-radius: 10px; text-decoration: none; font-weight: bold;"
            href="{{ env('APP_URL') }}/post/{{ $slug }}">See your post: {{ $title }}!</a>
        <p>Thank you for blogging with us!</p>
    </div>
</div>

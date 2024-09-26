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
        <h4>Here is your {{ date('F Y') }} activity recap:</h4>
        <p>
            Posts Made: <strong>{{ $postCount }}</strong>
        </p>
        <p>
            Friends Made: <strong>{{ $followingsCount }}</strong>
        </p>
        <p>
            New Friends: <strong>{{ $followersCount }}</strong>
        </p>
    </div>
</div>

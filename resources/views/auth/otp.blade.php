<form method="POST" action="{{ route('otp.verify') }}">
    @csrf
    <input type="text" name="otp" placeholder="OTP">
    <button type="submit">Təsdiqlə</button>
</form>

<div class="container">
    <div class="row">
        <div class="col-xl-6 offset-md-3">
            <div class="sign-in-form form-box">
                <h1 class="text-head align-c">Sign in</h1>
                <form name="form-sign-in" action="/sign-in-authenticate<?php echo $data["redirect"] ?>" method="post">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password</label>
                        <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter your password">
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="status"> Remember me</label>
                    </div>
                    <div class="form-group align-c">
                    <button type="submit" class="btn btn-primary btn-md btn-round-10">Submit</button>
                    </div>
                </form>
                <div class="row">
                    <div class="col-4"><a href="/sign-up" class="text-sm">Sign up</a></div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            var check = false;
            return this.optional(element) || regexp.test(value);
        }
    );
    var form_name ="sign-in";
    var form_validation=
        {
            rules: {
                email: {required:true,maxlength: 64,regex : /^[^@\s<&>]+@([-a-z0-9]+\.)+[a-z]{2,}$/},
                password: {required: true, minlength: 5 }
            },
            messages: {
                email: "Email required",
                password: "Password required"
            }
        };
</script>
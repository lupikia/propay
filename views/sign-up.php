<div class="container">
    <div class="row">
        <div class="col-xl-6 offset-md-3">
            <div class="sign-in-form form-box">
                <h1 class="text-head align-c">Sign up</h1>
                <form id="form-sign-up" name="form-sign-up">
                    <div class="form-group">
                        <label for="email">*Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="surname">*Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter your surname">
                    </div>

                    <div class="form-group">
                        <label for="surname">*Mobile Number</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter your mobile number">
                    </div>

                    <div class="form-group">
                        <label for="birth">*Select language</label>
                        <select type="text" class="form-control" id="language" name="language">
                            <option selected>English</option>
                            <option>French</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email">*Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                    </div>

                    <div class="form-group">
                        <label for="pwd">*Password</label>
                        <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter your password">
                    </div>
                    <div class="form-group align-c">
                        <button type="submit" class="btn btn-primary btn-md btn-round-10">Sign up</button>
                    </div>
                </form>
                <div class="row">
                    <div class="col-12 align-r">Already registered<a href="/" class="text-sm"> sign in</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    var form_name ="sign-up";
    var redirect='<?php echo $data["redirect"] ?>';

    var form_validation=
        {
            rules: {
                name: {required:true,minlength: 3,regex : /^[a-zA-Z\s]+$/},
                surname: {required:true,maxlength: 20,regex : /^[a-zA-Z\s]+$/},
                mobile: {required:true,maxlength: 11,regex : /^[0-9]{10}$/},
                email: {required:true,maxlength: 64,regex : /^[^@\s<&>]+@([-a-z0-9]+\.)+[a-z]{2,}$/},
                password: {required: true, minlength: 5 }
            },
            messages: {
                name: "Name required, only letters",
                surname: "Surname required, only letters",
                mobile: "Mobile required, only numbers",
                email: "Email required",
                password: "Password required"
            },
            submitHandler:function(e)
            {
                var data = get_form_data_json("form-sign-up");
                ajax_call("/service/user/create","POST", JSON.stringify(data),function (request)
                {
                    if(request.success)
                    {
                        window.location="/";
                    }else
                    {
                        invoke_pop_up("error-pop",request.data.error_code,request.error,request.data.contact)
                    }
                });

            }
        };
</script>

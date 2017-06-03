<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
<title>注册</title>
<link rel="stylesheet" href="css/bootstrap.css" />
<link rel="stylesheet" href="css/bootstrapValidator.css" />
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrapValidator.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<!-- form: -->
			<section>
				<div class="col-lg-8 col-lg-offset-2">
					<div class="page-header">
						<h2>注册</h2>
					</div>
					<form id="defaultForm" method="post" class="form-horizontal"
						action="register_chk.php">
						<div class="form-group">
							<label class="col-lg-3 control-label">Username</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" name="username" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Email address</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" name="email" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Password</label>
							<div class="col-lg-5">
								<input type="password" class="form-control" name="password" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Gender</label>
							<div class="col-lg-5">
								<div class="radio">
									<label> <input type="radio" name="gender" value="male" /> Male
									</label>
								</div>
								<div class="radio">
									<label> <input type="radio" name="gender" value="female" />
										Female
									</label>
								</div>
								<div class="radio">
									<label> <input type="radio" name="gender" value="other" />
										Other
									</label>
								</div>
							</div>
						</div>
						<div class="form-group hide">
							<div class="col-lg-9 col-lg-offset-3">
								<ul id="errors"></ul>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-9 col-lg-offset-3">
								<button type="submit" class="btn btn-primary">Sign up</button>
							</div>
						</div>
					</form>
				</div>
			</section>
			<!-- :form -->
		</div>
	</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#defaultForm')
        .bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                username: {
                    message: '用户名无效',
                    validators: {
                        notEmpty: {
                            message: '用户名不能为空'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: '用户名长度大于6且小于30'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: '用户名只能包括数字、字母、下划线'
                        },
                        different: {
                            field: 'password',
                            message: '用户名和密码不能一致'
                        }
                    }
                },
                email: {
                    validators: {
                    	notEmpty: {
                            message: '邮箱名不能为空'
                        },
               		    regexp: {
                   			regexp:/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/,
                  		    message: '邮箱格式错误'
             		   }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: '密码不能为空'
                        },
                        stringLength:{
                            min:6,
                            max:20,
                            message:'密码长度大于6小于20'
                        },
                        different: {
                            field: 'username',
                            message: '密码和用户名不能一致'
                        }
                    }
                },
                gender: {
                    validators: {
                        notEmpty: {
                            message: 'The gender is required'
                        }
                
                    }
                }
            }
        })

});
</script>
</body>
</html>

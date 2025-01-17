<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Authorization using JSON Web Tokens and PHP</title>
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/signin.css" rel="stylesheet">
</head>

<body class="text-center">
  <main class="form-signin">
    <form method="post" action="authenticate.php" id="frmLogin">
      <h1 class="h3 mb-3 fw-normal">Login In</h1>

      <label for="inputEmail" class="visually-hidden">Email address</label>
      <input type="text" id="inputEmail" class="form-control" placeholder="Email address or username" required
        autofocus="">

      <label for="inputPassword" class="visually-hidden">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>

      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>

      <p class="mt-5 mb-3 text-muted">&copy; 2017-2021</p>
    </form>
  </main>

  <script>
    const store = {};
    const loginButton = document.querySelector('#frmLogin');
    const form = document.forms[0];

    // Inserts the jwt to the store object
    store.setJWT = function (data) {
      this.JWT = data;
    };

    loginButton.addEventListener('submit', async (e) => {
      e.preventDefault();

      const res = await fetch('/authenticate.php', {
        method: 'POST',
        headers: {
          'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: JSON.stringify({
          username: form.inputEmail.value,
          password: form.inputPassword.value
        })
      });

      if (res.status >= 200 && res.status <= 299) {
        const jwt = await res.text();
        store.setJWT(jwt);
        frmLogin.style.display = 'none';
      } else {
        // Handle errors
        console.log(res.status, res.statusText);
      }
    });

  </script>
</body>

</html>


$(document).ready(function(){
const store = {};
    const loginButton = $('#frmLogin');
    const btnGetResource = $('#btnGetResource');
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
        btnGetResource.style.display = 'block';
      } else {
        // Handle errors
        console.log(res.status, res.statusText);
      }
    });

    btnGetResource.addEventListener('click', async (e) => {
      const res = await fetch('/resource.php', {
        headers: {
          'Authorization': `Bearer ${store.JWT}`
        }
      });
      const timeStamp = await res.text();
      console.log(timeStamp);
    });
});

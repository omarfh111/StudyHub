$(document).ready(function() {
  // Fonction pour vérifier le statut de réponse
  function checkReponseStatus() {
      $.ajax({
          url: 'check_reponse_status.php', // Chemin vers le fichier PHP
          method: 'GET',
          dataType: 'json',
          success: function(response) {
              if (response.status === 'success') {
                  // Vérifier si le cookie 'notification_count' existe
                  var notificationCount = getCookie('notification_count');
                  if (!notificationCount) {
                      notificationCount = 0;
                  }

                  // Si moins de 3 notifications ont été affichées
                  if (notificationCount < 3) {
                      // Afficher la notification
                      var notification = $('<div id="notification" class="alert alert-success text-center"></div>')
                          .text(response.message)
                          .css({
                              position: 'fixed',
                              top: '20px',
                              left: '50%',
                              transform: 'translateX(-50%)',
                              zIndex: '9999',
                              backgroundColor: 'green',
                              color: 'white'
                          });
                      $('body').append(notification);

                      // Cacher la notification après 5 secondes
                      setTimeout(function() {
                          notification.fadeOut(300, function() {
                              notification.remove();
                          });
                      }, 5000);

                      // Incrémenter le compteur et mettre à jour le cookie
                      notificationCount++;
                      setCookie('notification_count', notificationCount, 365); // Expiration dans 1 an
                  }
              }
          },
          error: function() {
              console.error('Erreur lors de la vérification des réponses.');
          }
      });
  }

  // Lancer la vérification toutes les 10 secondes (10 000 ms)
  setInterval(checkReponseStatus, 10000);

  // Fonction pour obtenir la valeur d'un cookie
  function getCookie(name) {
      var nameEQ = name + "=";
      var ca = document.cookie.split(';');
      for (var i = 0; i < ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) == ' ') c = c.substring(1, c.length);
          if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
      }
      return null;
  }

  // Fonction pour définir un cookie
  function setCookie(name, value, days) {
      var d = new Date();
      d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
      var expires = "expires=" + d.toUTCString();
      document.cookie = name + "=" + value + ";" + expires + ";path=/";
  }
});
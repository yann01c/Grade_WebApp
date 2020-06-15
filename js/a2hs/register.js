// Register service worker to control making site work offline

if ('serviceWorker' in navigator) {
    navigator.serviceWorker
             .register('service-worker.js')
             .then(function() { console.log('Service Worker Registered'); });
  }

// Ask for Permission
Notification.requestPermission(function(status) {
  console.log('Notification permission status:', status);
});

// Send notification if granted
function displayNotification() {
  if (Notification.permission == 'granted') {
    navigator.serviceWorker.getRegistration().then(function(req) {
      var options = {
        body: 'This is the BODY!',
        icon: '../../images/icons/iphone/icon_iphone_orange.png',
        vibrate: [0, 100, 0],
        data: {
          dateOfArrival: Date.now,
          primaryKey: 1
        },
        actions: [
          {action: 'explore', title: 'Visit SPIE Grades',
            icon: '../../images/icons/checkmark.png'},
          {action: 'close', title: 'Close Notification',
            icon: '../../images/icons/x.png'},
        ]
      };
      req.showNotification('Test Notification', options);
    });
  }
}

displayNotification();

// // Check if subscription was made
// if ('serviceWorker' in navigator) {
//   navigator.serviceWorker.register('sw.js').then(function(reg) {
//     console.log('Service Worker Registered!', reg);

//     reg.pushManager.getSubscription().then(function(sub) {
//       if (sub === null) {
//         // Update UI to ask user to register for Push
//         console.log('Not subscribed to push service!');
//       } else {
//         // We have a subscription, update the database
//         console.log('Subscription object: ', sub);
//       }
//     });
//   })
//    .catch(function(err) {
//     console.log('Service Worker registration failed: ', err);
//   });
// }
// function subscribeUser() {
//   if ('serviceWorker' in navigator) {
//     navigator.serviceWorker.ready.then(function(reg) {

//       reg.pushManager.subscribe({
//         userVisibleOnly: true
//       }).then(function(sub) {
//         console.log('Endpoint URL: ', sub.endpoint);
//       }).catch(function(e) {
//         if (Notification.permission === 'denied') {
//           console.warn('Permission for notifications was denied');
//         } else {
//           console.error('Unable to subscribe to push', e);
//         }
//       })
//     })
//   }
// }

// let deferredPrompt;
// const addBtn = document.querySelector('.add-button');
// addBtn.style.display = 'none';

// window.addEventListener('beforeinstallprompt', (e) => {
//     // Prevent Chrome 67 and earlier from automatically showing the prompt
//     e.preventDefault();
//     // Stash the event so it can be triggered later.
//     deferredPrompt = e;
//     // Update UI to notify the user they can add to home screen
//     addBtn.style.display = 'block';
  
//     addBtn.addEventListener('click', (e) => {
//       // hide our user interface that shows our A2HS button
//       addBtn.style.display = 'none';
//       // Show the prompt
//       deferredPrompt.prompt();
//       // Wait for the user to respond to the prompt
//       deferredPrompt.userChoice.then((choiceResult) => {
//           if (choiceResult.outcome === 'accepted') {
//             console.log('User accepted the A2HS prompt');
//           } else {
//             console.log('User dismissed the A2HS prompt');
//           }
//           deferredPrompt = null;
//         });
//     });
//   });
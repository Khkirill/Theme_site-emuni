// 'use strict';
// const parallax = () => {
//   (function( $ ) {
//     $( document ).ready(function() {
//
//
//       if ( $( '.btParallax' ).length > 0 ) {
//
//         window.bt_raf_lock = false;
//
//         $( window ).on( 'mousewheel', function( e ) {
//           if ( ! window.bt_raf_lock ) {
//             window.bt_raf_lock = true;
//             bt_requestAnimFrame( bt_raf_loop );
//           }
//         });
//
//         $( window ).on( 'scroll resize', function() {
//           if ( ! window.bt_raf_lock ) {
//             window.bt_raf_lock = true;
//             bt_requestAnimFrame( bt_raf_loop );
//           }
//         });
//
//         $( window ).on( 'load', function() {
//           bt_requestAnimFrame( bt_raf_loop );
//         });
//
//         window.bt_requestAnimFrame = function() {
//           return (
//               window.requestAnimationFrame       ||
//               window.webkitRequestAnimationFrame ||
//               window.mozRequestAnimationFrame    ||
//               window.oRequestAnimationFrame      ||
//               window.msRequestAnimationFrame     ||
//               function( callback ) {
//                 window.setTimeout( callback, 1000 / 60 );
//               }
//           );
//         }();
//
//         var bt_raf_loop = function() {
//
//           $( '.btParallax' ).each(function() {
//             var bounds = this.getBoundingClientRect();
//             if ( bounds.top < window.innerHeight && bounds.bottom > 0 ) {
//               var speed = $( this ).data( 'parallax' ) + 0.0001;
//               var offset = 0;
//               if( window.innerWidth > 1024 ) offset= parseFloat( $( this ).data( 'parallax-offset' ) );
//               var ypos = ( bounds.top ) * speed;
//               var firefox  = navigator.userAgent.indexOf('Firefox') > -1;
//               if(firefox && $('body').hasClass('btMenuVerticalLeftEnabled')) ypos = -ypos;
//               $( this ).css( 'background-position', '50% ' + ( ypos + offset ) + 'px' );
//             }
//             if(isIOS){
//               $( this ).css( 'background-attachment', ': scroll', 'background-position', '50% 0' );
//               console.log(alert(isIOS))
//             }
//           });
//
//
//           window.bt_raf_lock = false;
//
//         }
//
//         // bt_requestAnimFrame( bt_raf_loop );
//
//       }
//     });
//
//   })( jQuery );
// };
// export default parallax;
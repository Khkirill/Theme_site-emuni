/**
 *  Made by Ilona Taran
 *
 *  Type of valid: name, mail, phone, message, other
 *  Example:
 *  const arr = new Map([
 *    [$("#name"), 'name'],
 *    [$("#email"), 'mail'],
 *    [$("#phone"), 'phone'],
 *    [$("#country"),'other'],
 *    [$("#message"), 'message'],
 *  ]);
 *
 *  validateWhenBlur(arr);
 *  if (validateWhenSend(arr))
 *
 **/
"use strict";

class Valid {
  checkField(item, conditionName, sending) {
    let message = "This input is invalid";

    const rv_name = /^[a-zA-Z'][a-zA-Z-' ]+[a-zA-Z']?$/;
    const rv_email =
      /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;

    // /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,3}))$/;
    const rv_data =
      /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;
    const rv_number = /^\d{1,}$/;
    //phone=^\+?(?!(?:.*-){3})(?!.*--)(?=[^()]*\([^()]+\)[^()]*$|[^()]*$)(?!.*-.*[()])(?:[()-]*\d){10}[()-]*$
    let rv_url = /[-a-zA-Z0-9@:%_\+.~#?&\/=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&\/=]*)?/gi;
    let condition;

    switch (conditionName) {
      case "name":
        condition = item.value.length >= 2 && rv_name.test(item.value) && item.value.length <= 25;
        if (item.value.length < 2) {
          message = "Not less than 2 symbols please";
        } else if (item.value.length >= 25 && rv_name.test(item.value)) {
          message = "No more than 25 symbols please";
        }
        break;
      case "mail":
        condition =
          item.value != "" &&
          rv_email.test(item.value) &&
          item.value.indexOf("@") <= 64 &&
          item.value.lastIndexOf(".") - item.value.indexOf("@") <= 188;
        if (!condition) message = "Incorrect email format";
        break;
      case "phone":
        condition = item.value != "" && rv_number.test(item.value) && item.value.length >= 10 && item.value.length <= 15;
        if (item.value.length <= 10) {
          message = "Not less than 10 symbols please";
        } else if (item.value.length >= 15) {
          message = "No more than 15 symbols please";
        }
        break;
      case "message":
        condition = item.value != "" && item.value.length >= 2 && item.value.length <= 180;
        if (item.value.length < 2) {
          message = "Not less than 2 symbols please";
        } else if (item.value.length >= 180) {
          message = "No more than 180 symbols please";
        }
        break;
      default:
        condition = item.value != "";
        break;
    }

    const parent_item = item.closest(".container_limit");

    if (condition) {
      if (sending) {
        parent_item.classList.remove("container_limit_correct");
      } else {
        parent_item.classList.add("container_limit_correct");
      }
      if (parent_item.querySelector(".limit_text")) {
        parent_item.querySelector(".limit_text").textContent = "";
      }

      parent_item.classList.remove("container_limit_incorrect");
      return true;
    } else {
      if (parent_item.querySelector(".limit_text")) {
        parent_item.querySelector(".limit_text").textContent = message;
      }
      parent_item.classList.remove("container_limit_correct");
      parent_item.classList.add("container_limit_incorrect");
      return false;
    }
  }
  validateWhenBlur(arr) {
    arr.forEach((value, key) => {
      key.addEventListener("blur", () => {
        this.checkField(key, value, false);
      });
    });
  }
  validateWhenKeyUp(arr) {
    arr.forEach((value, key) => {
      key.addEventListener("keyup", () => {
        this.checkField(key, value, false);
      });
    });
  }
  validateWhenSend(arr) {
    var boll = true;
    arr.forEach((value, key) => {
      boll &= this.checkField(key, value, true);
    });
    return boll;
  }
}

export default Valid;

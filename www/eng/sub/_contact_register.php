<?php 
include_once(G5_PATH.'/eng/include/sub_top.php');
?>

<div id="contact" class="contents">
  <?php sub_top($sb_menus, 'cs', 'contact'); ?>

  <div id="sb-contents">
    <section class="board-write">
      <h2 class="sound_only">문의하기 작성페이지</h2>
      <div class="container">
        <div class="wrapper">
          <div class="sec_ct">
            <div class="sb_top-title">
              <p class="sb_top-title-text1"><b>Do you have any questions? <br/>Please enter the information below and contact us.</b></p>
            </div>

            <form action="/eng/api/contact.php" method="post">
              <div class="form-wrap">
                <div class="form-box">
                  <div class="form-li form-li-name">
                    <div class="form-text">Name<span class="required">*</span></div>
                    <div class="form-cont">
                      <input type="text" name="inq_name" required class="form-input">
                    </div>
                  </div>
                </div>
                <div class="form-box">
                  <div class="form-li form-li-email">
                    <div class="form-text">Email<span class="required">*</span></div>
                    <div class="form-cont">
                      <div class="mail-input-wrap">
                        <div class="mail-input-li email-id">
                          <input type="text" name="inq_mail01" id="inq_mail01" required class="form-input full">
                        </div>
                        <div class="mail-input-li email-sym">@</div>
                        <div class="mail-input-li email-domain">
                          <input type="text" name="inq_mail02" id="inq_mail02" required class="form-input disabled" readonly>
                          <select name="inq_mail03" id="inq_mail03" class="nc-sel form-sel doamin-sel" onchange="emailDomain(this.value)">
                            <option value="">Choose an option</option>
                            <option value="naver.com">naver.com</option>
                            <option value="gmail.com">gmail.com</option>
                            <option value="hanmail.net">hanmail.net</option>
                            <option value="nate.com">nate.com</option>
                            <option value="kakao.com">kakao.com</option>
                            <option value="w">write in email</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-box">
                  <div class="form-li">
                    <div class="form-text">Area</div>
                    <div class="form-cont">
                      <input type="text" name="inq_area" class="form-input full">
                    </div>
                  </div>
                </div>
                <div class="form-box">
                  <div class="form-li">
                    <div class="form-text">Company<br/>/School</div>
                    <div class="form-cont">
                      <input type="text" name="inq_company" class="form-input full">
                    </div>
                  </div>
                </div>
                <div class="form-box">
                  <div class="form-li">
                    <div class="form-text">Department</div>
                    <div class="form-cont">
                      <input type="text" name="inq_depart" class="form-input full">
                    </div>
                  </div>
                </div>
                <div class="form-box">
                  <div class="form-li">
                    <div class="form-text">Phone number<span class="required">*</span></div>
                    <div class="form-cont">
                      <input type="text" name="inq_phone" required class="form-input">
                    </div>
                  </div>
                </div>
                <div class="form-box">
                  <div class="form-li">
                    <div class="form-text">Address</div>
                    <div class="form-cont">
                      <input type="text" name="inq_add" required class="form-input full">
                    </div>
                  </div>
                </div>
                <div class="form-box">
                  <div class="form-li">
                    <div class="form-text">Title<span class="required">*</span></div>
                    <div class="form-cont">
                      <input type="text" name="inq_subj" required class="form-input full" maxlength="255">
                    </div>
                  </div>
                </div>
                <div class="form-box">
                  <div class="form-li">
                    <div class="form-text">Questions<span class="required">*</span></div>
                    <div class="form-cont">
                      <textarea data-lenis-prevent name="inq_content" id="" required class="form-textar full" cols="30" rows="10"></textarea>
                    </div>
                  </div>
                </div>
                <div class="form-box">
                  <div class="form-li">
                    <div class="form-text">Password<span class="required">*</span></div>
                    <div class="form-cont">
                      <input type="password" name="inq_pw" required class="form-input" maxlength="255">
                      <p class="form-cau-text">※Please enter the password you entered when writing the inquiry. If you don't know the password, you can't view it, and please contact the administrator.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="inquiry-btn-box">
                <button type="submit" class="submit-btn">To make an inquiry</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

<script>
// 이메일 도메인 선택 기능
const emailDomain = (v) => {
  let emailDomain_value = v;
  const emailDomain_input = document.getElementById('inq_mail02');

  if(emailDomain_value === 'w') {
    emailDomain_input.value = "";
    emailDomain_input.readOnly = false;
    emailDomain_input.classList.remove('disabled');
    emailDomain_input.focus();
  } else {
    emailDomain_input.value = emailDomain_value;
    emailDomain_input.readOnly = true;
    emailDomain_input.classList.add('disabled');
  }
}
</script>
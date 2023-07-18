<?php 
include_once(G5_INCLUDE_PATH.'/sub_top.php');
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
              <p class="sb_top-title-text1"><b>궁금하신 점이 있으신가요? <br/>아래 내용을 입력 후 문의해주세요.</b></p>
            </div>

            <form action="/api/contact.php" method="post">
              <div class="form-wrap">
                <div class="form-box">
                  <div class="form-li form-li-name">
                    <div class="form-text">이름<span class="required">*</span></div>
                    <div class="form-cont">
                      <input type="text" name="inq_name" required class="form-input">
                    </div>
                  </div>
                </div>
                <div class="form-box">
                  <div class="form-li form-li-email">
                    <div class="form-text">이메일<span class="required">*</span></div>
                    <div class="form-cont">
                      <div class="mail-input-wrap">
                        <div class="mail-input-li email-id">
                          <input type="text" name="inq_mail01" id="inq_mail01" required class="form-input full">
                        </div>
                        <div class="mail-input-li email-sym">@</div>
                        <div class="mail-input-li email-domain">
                          <input type="text" name="inq_mail02" id="inq_mail02" required class="form-input disabled" readonly>
                          <select name="inq_mail03" id="inq_mail03" class="nc-sel form-sel doamin-sel" onchange="emailDomain(this.value)">
                            <option value="">선택하세요.</option>
                            <option value="naver.com">naver.com</option>
                            <option value="gmail.com">gmail.com</option>
                            <option value="hanmail.net">hanmail.net</option>
                            <option value="nate.com">nate.com</option>
                            <option value="kakao.com">kakao.com</option>
                            <option value="w">직접입력</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-box">
                  <div class="form-li">
                    <div class="form-text">지역</div>
                    <div class="form-cont">
                      <input type="text" name="inq_area" class="form-input full">
                    </div>
                  </div>
                </div>
                <div class="form-box">
                  <div class="form-li">
                    <div class="form-text">회사/학교</div>
                    <div class="form-cont">
                      <input type="text" name="inq_company" class="form-input full">
                    </div>
                  </div>
                </div>
                <div class="form-box">
                  <div class="form-li">
                    <div class="form-text">부서</div>
                    <div class="form-cont">
                      <input type="text" name="inq_depart" class="form-input full">
                    </div>
                  </div>
                </div>
                <div class="form-box">
                  <div class="form-li">
                    <div class="form-text">전화번호<span class="required">*</span></div>
                    <div class="form-cont">
                      <div class="i-col-0 phone-input-wrap">
                        <div class="phone-input-li phone1">
                          <select name="inq_phone1" id="" class="nc-sel form-sel tel-sel">
                            <option value="">선택</option>
                            <option value="010">010</option>
                          </select>
                        </div>
                        <div class="phone-input-li phone-sym">-</div>
                        <div class="phone-input-li">
                          <input type="text" name="inq_phone2" required class="form-input full" maxlength="4">
                        </div>
                        <div class="phone-input-li phone-sym">-</div>
                        <div class="phone-input-li">
                          <input type="text" name="inq_phone3" required class="form-input full" maxlength="4">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-box">
                  <div class="form-li">
                    <div class="form-text">주소</div>
                    <div class="form-cont">
                      <div class="address-input-wrap">
                        <div class="address-input-box btn-box">
                          <input type="text" name="inq_post_num" placeholder="우편번호" readonly id="sample3_postcode" class="form-input">
                          <button type="button" class="add-btn" onclick="sample3_execDaumPostcode()">주소검색</button>
                        </div>
                        <div id="add-wrap"></div>
                        <div class="address-input-box">
                          <input type="text" name="inq_add1" placeholder="주소를 선택해주세요." id="sample3_address" readonly class="form-input full">
                        </div>
                        <div class="address-input-box">
                          <input type="text" name="inq_add2" placeholder="상세주소를 입력하세요." id="sample3_detailAddress" class="form-input full">
                        </div>
                        <div class="address-input-box" style="display: none;">
                          <input type="text" name="inq_add3" placeholder="참고항목을 입력하세요." id="sample3_extraAddress" class="form-input full">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-box">
                  <div class="form-li">
                    <div class="form-text">제목<span class="required">*</span></div>
                    <div class="form-cont">
                      <input type="text" name="inq_subj" required class="form-input full" maxlength="255">
                    </div>
                  </div>
                </div>
                <div class="form-box">
                  <div class="form-li">
                    <div class="form-text">문의사항<span class="required">*</span></div>
                    <div class="form-cont">
                      <textarea data-lenis-prevent name="inq_content" id="" required class="form-textar full" cols="30" rows="10"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="inquiry-btn-box">
                <button type="submit" class="submit-btn">문의하기</button>
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

// 우편번호 찾기 찾기 화면을 넣을 element
var element_wrap = document.getElementById('add-wrap');

function foldDaumPostcode() {
    // iframe을 넣은 element를 안보이게 한다.
    element_wrap.style.display = 'none';
}

function sample3_execDaumPostcode() {
    // 현재 scroll 위치를 저장해놓는다.
    var currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
    new daum.Postcode({
        oncomplete: function(data) {
            // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

            // 각 주소의 노출 규칙에 따라 주소를 조합한다.
            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
            var addr = ''; // 주소 변수
            var extraAddr = ''; // 참고항목 변수

            //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
            if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                addr = data.roadAddress;
            } else { // 사용자가 지번 주소를 선택했을 경우(J)
                addr = data.jibunAddress;
            }

            // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
            if(data.userSelectedType === 'R'){
                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraAddr !== ''){
                    extraAddr = ' (' + extraAddr + ')';
                }
                // 조합된 참고항목을 해당 필드에 넣는다.
                document.getElementById("sample3_extraAddress").value = extraAddr;

            } else {
                document.getElementById("sample3_extraAddress").value = '';
            }

            // 우편번호와 주소 정보를 해당 필드에 넣는다.
            document.getElementById('sample3_postcode').value = data.zonecode;
            document.getElementById("sample3_address").value = addr;
            // 커서를 상세주소 필드로 이동한다.
            document.getElementById("sample3_detailAddress").focus();

            // iframe을 넣은 element를 안보이게 한다.
            // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
            element_wrap.style.display = 'none';

            // 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
            document.body.scrollTop = currentScroll;
        },
        // 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
        onresize : function(size) {
            element_wrap.style.height = size.height+'px';
        },
        width : '100%',
        height : '100%'
    }).embed(element_wrap);

    // iframe을 넣은 element를 보이게 한다.
    element_wrap.style.display = 'block';
}
</script>
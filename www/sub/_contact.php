<div class="sub_contents" style="padding-top: 100px;">
  <div class="form-wrap">
    <form action="/api/contact.php" method="post">
      <div class="inquiry-wrap">
        <div class="i-col-0 inquiry-li">
          <div class="inquiry-text">이름</div>
          <div class="inquiry-cont">
            <input type="text" name="inq_name">
          </div>
        </div>
        <div class="i-col-0 inquiry-li">
          <div class="inquiry-text">이메일</div>
          <div class="inquiry-cont">
            <div class="i-ccol-0 mail-input-wrap">
              <div class="mail-input-li">
                <input type="text" name="inq_mail01">
              </div>
              <div class="mail-input-li">@</div>
              <div class="mail-input-li">
                <input type="text" name="inq_mail02">
              </div>
            </div>
          </div>
        </div>
        <div class="i-col-0 inquiry-li">
          <div class="inquiry-text">지역</div>
          <div class="inquiry-cont">
            <input type="text" name="inq_area">
          </div>
        </div>
        <div class="i-col-0 inquiry-li">
          <div class="inquiry-text">회사/학교</div>
          <div class="inquiry-cont">
            <input type="text" name="inq_company">
          </div>
        </div>
        <div class="i-col-0 inquiry-li">
          <div class="inquiry-text">부서</div>
          <div class="inquiry-cont">
            <input type="text" name="inq_depart">
          </div>
        </div>
        <div class="i-col-0 inquiry-li">
          <div class="inquiry-text">전화번호</div>
          <div class="inquiry-cont">
            <div class="i-col-0 phone-input-wrap">
              <div class="phone-input-li">
                <select name="inq_phone1" id="">
                  <option value="">선택</option>
                  <option value="010">010</option>
                </select>
              </div>
              <div class="phone-input-li">
                <input type="text" name="inq_phone2">
              </div>
              <div class="phone-input-li">
                <input type="text" name="inq_phone3">
              </div>
            </div>
          </div>
        </div>
        <div class="i-col-0 inquiry-li">
          <div class="inquiry-text">주소</div>
          <div class="inquiry-cont">
            <div class="address-input-wrap">
              <div class="address-input-box btn-box">
                <input type="text" name="inq_post_num" placeholder="우편번호" readonly id="sample3_postcode">
                <button type="button" onclick="sample3_execDaumPostcode()">주소검색</button>
              </div>
              <div id="add-wrap"></div>
              <div class="address-input-box">
                <input type="text" name="inq_add1" placeholder="주소를 선택해주세요." id="sample3_address" readonly>
              </div>
              <div class="address-input-box">
                <input type="text" name="inq_add2" placeholder="상세주소를 입력하세요." id="sample3_detailAddress">
              </div>
              <div class="address-input-box" style="display: none;">
                <input type="text" name="inq_add3" placeholder="참고항목을 입력하세요." id="sample3_extraAddress">
              </div>
            </div>
          </div>
        </div>
        <div class="i-col-0 inquiry-li">
          <div class="inquiry-text">문의사항</div>
          <div class="inquiry-cont">
            <textarea name="inq_content" id="" cols="30" rows="10"></textarea>
          </div>
        </div>
      </div>
      <div class="inquiry-btn-box">
        <button type="submit">문의하기</button>
      </div>
    </form>
  </div>
</div>


<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

<script>
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
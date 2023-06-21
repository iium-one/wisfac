// 숫자가 10보다 작을 경우 앞에 0을 추가
const addZero = num =>  num < 10 ? '0' + num : num;
export { addZero }
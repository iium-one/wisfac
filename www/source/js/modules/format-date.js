//날짜 형식 변경 함수 (날짜데이터, 구분자)
import { addZero } from './add-zero';

const formatDate = (pDateString, pDelimiter) => {
  let delimiter = pDelimiter ? pDelimiter : '-';
  let formattedDate = "";
  if (!pDateString) {
    console.error('Date data is empty.');
    formattedDate = `0000${delimiter}00${delimiter}00`;
  } else {
    let dateObj = new Date(pDateString);
    let year = dateObj.getFullYear();
    let month = dateObj.getMonth() + 1;
    let day = dateObj.getDate();
    
    formattedDate = `${year}${delimiter}${addZero(month)}${delimiter}${addZero(day)}`;
  }

  return formattedDate;
}

export { formatDate };
/**
 * @param {string} date ddd mmm ddd yyyy HH xxx-xxxx (local hour standard)
 * @return {string} yyyy-mm-dd
 */
export default function ConvertDataToStandard(date) {
  if (date) {
    const oldDate = JSON.stringify(date);
    const newDate = oldDate.slice(1,11);
    return newDate;
  }

  return null
}
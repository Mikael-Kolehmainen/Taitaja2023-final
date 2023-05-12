const array = [4, 0, 1, 2, 3, 4, 5, 6, 7, 8];

const formatPhoneNumber = (array) => {
  let phoneNumber = array.join("");
  const twoFirstNumbers = phoneNumber[0] + phoneNumber[1];
  const threeNumbers = phoneNumber[2] + phoneNumber[3] + phoneNumber[4];
  const threeNumbersAfterThat = phoneNumber[5] + phoneNumber[6] + phoneNumber[7] + phoneNumber[8];

  phoneNumber = twoFirstNumbers+ " " + threeNumbers + " " + threeNumbersAfterThat;

  phoneNumber = "+358 " + phoneNumber;

  return phoneNumber;
};

console.log(formatPhoneNumber(array));

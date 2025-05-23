export function isValidObject(v) {
    return Object.prototype.toString.call(v) === "[object Object]";
}

export function isValidString(v) {
    return typeof v === "string" && v.trim().length;
}

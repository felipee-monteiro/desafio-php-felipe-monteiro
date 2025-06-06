export function isValidObject(v) {
    return Object.prototype.toString.call(v) === "[object Object]";
}

export function isValidString(v) {
    return typeof v === "string" && v.trim().length;
}

export function rmStringSpace(v) {
    if (!isValidString(v)) {
        throw new TypeError("v is not a valid string");
    }

    return v.trim();
}

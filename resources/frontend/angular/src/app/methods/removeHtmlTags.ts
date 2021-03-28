export function removeHtmlTags(text: string): string {
  const regexOpen = /<[^>]*>/g;
  const regexClose = /<\/[^>]*>/g;

  return text.replace(regexClose, ' ').replace(regexOpen, '');
}

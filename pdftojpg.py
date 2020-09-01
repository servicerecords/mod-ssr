import pdf2image
import argparse
import base64

from io import BytesIO

parser = argparse.ArgumentParser(description='Process PDF files back as JPEG images')
parser.add_argument('src', type=str)

PDF_PATH = ''


def pdf_to_pil():
    image = pdf2image.convert_from_path(PDF_PATH, dpi=200, output_folder='/tmp', fmt='jpg')
    buffered = BytesIO()
    image[0].save(buffered, format='JPEG')
    image_string = base64.b64encode(buffered.getvalue())
    print(image_string)


if __name__ == '__main__':
    args = parser.parse_args()
    PDF_PATH = args.src
    pdf_to_pil()

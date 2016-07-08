<?php


/**
 * Class ResponseMacroTest
 *
 * @group macro
 * @group response
 */
class ResponseMacroServiceProviderTest extends TestCase
{
    /**
     * TEST:        'success' response
     *
     * @group 200
     */
    public function testSuccessResponse()
    {
        $data = 'My unique success message';

        // SETUP:       Response
        $this->response = response()->success($data);

        // ASSERT:      Status
        $this->assertResponseStatus(200);

        // ASSERT:      Response
        $this->seeJson([
            'errors' => false,
            'data'   => $data,
        ]);
    }


    /**
     * TEST:        No content response
     *
     * @group error
     * @group 204
     */
    public function testNoContentResponse()
    {
        // SETUP:       Response
        $this->response = response()->noContent();

        // ASSERT:      Status
        $this->assertResponseStatus(204);
    }



    /**
     * TEST:        'error' response
     *
     * @group error
     * @group 400
     */
    public function testErrorResponse()
    {
        $message = 'My unique error message';

        // SETUP:       Response
        $this->response = response()->error($message);

        // ASSERT:      Status
        $this->assertResponseStatus(400);

        // ASSERT:      Response
        $this->seeJson([
            'errors'  => true,
            'message' => $message,
        ]);
    }


    /**
     * TEST:        'error' response with set HTTP Response code
     *
     * @group error
     * @group 500
     */
    public function testErrorResponseWithResponseCode()
    {
        $message = 'Test 500 error';

        // SETUP:       Response
        $this->response = response()->error($message, 500);

        // ASSERT:      Status
        $this->assertResponseStatus(500);

        // ASSERT:      Response
        $this->seeJson([
            'errors'  => true,
            'message' => $message,
        ]);
    }
}
